<?php
require_once("../../../conexao.php");
$tabela = 'feriados';
$data_atual = date('Y-m-d');

$busca = '%' . @$_POST['busca'] . '%';

// Pegar a página atual
if (@$_POST['pagina'] == "") {
    @$_POST['pagina'] = 0;
}

$pagina = intval(@$_POST['pagina']);
$limite = $pagina * $itens_pag;

$query = $pdo->query("SELECT id, data FROM $tabela ORDER BY id DESC");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {
    echo <<<HTML
    <small>
    <table class="table table-hover">
    <thead> 
    <tr> 
    <th>Data</th>    
    <th>Ações</th>
    </tr> 
    </thead> 
    <tbody>    
HTML;

    foreach ($res as $feriado) {
        $data = $feriado['data'];
        $id = $feriado['id'];

        echo <<<HTML
        <tr class="">
        <td>{$data}</td>
        <td>
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
        </td>
        </tr>
HTML;
    }

    echo <<<HTML
    </tbody>
    <small><div align="center" id="mensagem-excluir"></div></small>
    </table>
    </small>
HTML;
} else {
    echo '<small>Não possui nenhum registro Cadastrado!</small>';
}
?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#tabela').DataTable({
            "ordering": false,
            "stateSave": true
        });
        $('#tabela_filter label input').focus();
    });

    function editar(id, data) {
        $('#id').val(id);
        $('#data').val(data);

        $('#titulo_inserir').text('Editar Registro');
        $('#modalForm').modal('show');
    }

    function limparCampos() {
        $('#id').val('');
        $('#data').val('');
    }

    function mostrar(data) {
        $('#data').text(data);
        $('#modalDados').modal('show');
    }

    function excluir(id) {
        $.ajax({
            url: 'paginas/' + pag + "/excluir.php",
            method: 'POST',
            data: {id},
            dataType: "text",
            success: function (mensagem) {            
                if (mensagem.trim() == "Excluído com Sucesso") {                
                    var pagina = $("#pagina").val();
                    listarClientes(pagina);
                } else {
                    $('#mensagem-excluir').addClass('text-danger')
                    $('#mensagem-excluir').text(mensagem)
                }
            },
        });
    }
</script>
