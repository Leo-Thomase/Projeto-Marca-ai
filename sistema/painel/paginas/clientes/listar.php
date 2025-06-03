<?php 
require_once("../../../conexao.php");
$tabela = 'clientes';
$data_atual = date('Y-m-d');
$url_agendamento = $url_sistema.'agendamento';

$busca = '%'.@$_POST['busca'].'%';

// pegar a pagina atual
if(@$_POST['pagina'] == ""){
    @$_POST['pagina'] = 0;
}

$pagina = intval(@$_POST['pagina']);
$limite = $pagina * $itens_pag;


$query = $pdo->query("SELECT * FROM $tabela where nome LIKE '$busca' or telefone LIKE '$busca' ORDER BY id desc LIMIT $limite, $itens_pag");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

echo <<<HTML
	<small>
	<table class="table table-hover">
	<thead> 
	<tr> 
	<th>Nome</th>	
	<th class="esc">Telefone</th> 
	<th class="esc">Cadastro</th> 	
	<th class="esc">Retorno</th> 
	<th class="esc">Cartões</th> 
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];	
	$data_cad = $res[$i]['data_cad'];	
	$telefone = $res[$i]['telefone'];
	$cartoes = $res[$i]['cartoes'];
	$data_retorno = $res[$i]['data_retorno'];
	$ultimo_servico = $res[$i]['ultimo_servico'];

	$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
	$data_retornoF = implode('/', array_reverse(explode('-', $data_retorno)));

	
	$whats = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

	$query2 = $pdo->query("SELECT * FROM servicos where id = '$ultimo_servico'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res2) > 0){
		$nome_servico = $res2[0]['nome'];
	}else{
		$nome_servico = 'Nenhum!';
	}


	$query2 = $pdo->query("SELECT * FROM receber where pessoa = '$id' order by id desc limit 1");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res2) > 0){
		$obs_servico = $res2[0]['obs'];
		$valor_servico = $res2[0]['valor'];
		$data_servico = $res2[0]['data_lanc'];
		$valor_servico = number_format($valor_servico, 2, ',', '.');
		$data_servico = implode('/', array_reverse(explode('-', $data_servico)));
	}else{
		$obs_servico = '';
		$valor_servico = '';
		$data_servico = '';
	}

	
	

	if($data_retorno != "" and strtotime($data_retorno) <  strtotime($data_atual)){
		$classe_retorno = 'text-danger';
	}else{
		$classe_retorno = '';
	}
	
	 $query2 = $pdo->query("SELECT * FROM $tabela where nome LIKE '$busca' or telefone LIKE '$busca'");
	    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	    $total_reg2 = @count($res2);

	     $num_paginas = ceil($total_reg2/$itens_pag);


echo <<<HTML
<tr class="">
<td>{$nome}</td>
<td class="esc">{$telefone}</td>
<td class="esc">{$data_cadF}</td>
<td class="esc {$classe_retorno}">{$data_retornoF}</td>
<td class="esc">{$cartoes}</td>
<td>
		<big><a href="#" onclick="editar('{$id}','{$nome}', '{$telefone}', '{$cartoes}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$nome}', '{$telefone}', '{$cartoes}', '{$data_cadF}', '{$data_retornoF}', '{$nome_servico}', '{$obs_servico}', '{$valor_servico}', '{$data_servico}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>



		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>


		<big><a onclick="alertar('{$id}')" href="http://api.whatsapp.com/send?1=pt_BR&phone=$whats&text=Olá $nome, estamos sentindo muito sua falta. Caso queira fazer um novo agendamento é só acessar nosso site $url_agendamento, será um prazer atendê-lo novamente!!" target="_blank" title="Abrir Whatsapp"><i class="fa fa-whatsapp"></i></a></big>



		<big><a class="" href="#" onclick="contrato('{$id}','{$nome}')" title="Contrato de Serviço"><i class="fa fa-file-pdf-o text-primary"></i></a></big>

		</td>
</tr>
HTML;

}

echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
</small>



<hr>
   <div class="row" align="center">
     <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item">
              <a onclick="listarClientes(0)" class="paginador" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
HTML;

            for($i=0;$i<$num_paginas;$i++){
            $estilo = "";
            if($pagina >= ($i - 2) and $pagina <= ($i + 2)){
            if($pagina == $i)
              $estilo = "active";

          $pag = $i+1;
          $ultimo_reg = $num_paginas - 1;

echo <<<HTML

             <li class="page-item {$estilo}">
              <a onclick="listarClientes({$i})" class="paginador " href="#" >{$pag}
                
              </a></li>
HTML;

          } 
      } 

echo <<<HTML

            <li class="page-item">
              <a onclick="listarClientes({$ultimo_reg})" class="paginador" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>
      </div> 

HTML;  



}else{
	echo '<small>Não possui nenhum registro Cadastrado!</small>';
}

?>

<script type="text/javascript">
	$(document).ready( function () {
    $('#tabela').DataTable({
    		"ordering": false,
			"stateSave": true
    	});
    $('#tabela_filter label input').focus();
} );
</script>


<script type="text/javascript">
	function editar(id, nome, telefone, cartoes, cpf){
		$('#id').val(id);
		$('#nome').val(nome);		
		$('#telefone').val(telefone);		
		$('#cartao').val(cartoes);

		
		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
		
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#telefone').val('');
		$('#cartao').val('0');
	}
</script>



<script type="text/javascript">
	function mostrar(nome, telefone, cartoes, data_cad, data_nasc,  retorno, servico, obs, valor, data){

		$('#nome_dados').text(nome);		
		$('#data_cad_dados').text(data_cad);
		$('#cartoes_dados').text(cartoes);
		$('#telefone_dados').text(telefone);
		$('#retorno_dados').text(retorno);		
		$('#servico_dados').text(servico);
		$('#obs_dados_tab').text(obs);
		$('#servico_dados_tab').text(servico);
		$('#data_dados_tab').text(data);
		$('#valor_dados_tab').text(valor);

		$('#modalDados').modal('show');
	}
</script>



<script type="text/javascript">
	function contrato(id, nome){		
		$('#titulo_contrato').text(nome);
		$('#id_contrato').val(id);		
		$('#modalContrato').modal('show');
		listarTextoContrato(id);
		
	}



</script>