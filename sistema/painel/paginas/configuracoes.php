<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'configuracoes';
$data_atual = date('Y-m-d');

//verificar se ele tem a permissão de estar nessa página
if(@$configuracoes == 'ocultar'){
	echo "<script>window.location='../index.php'</script>";
	exit();
}

?>

<div class="row">

<form method="post" id="form-config">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Nome Barbearia</label>
								<input type="text" class="form-control" id="nome_sistema" name="nome_sistema" placeholder="Nome da Barbearia" value="<?php echo $nome_sistema ?>" required>    
							</div> 	
						</div>
						<div class="col-md-4">

							<div class="form-group">
								<label for="exampleInputEmail1">Email Barbearia</label>
								<input type="email" class="form-control" id="email_sistema" name="email_sistema" placeholder="Email" value="<?php echo $email_sistema ?>" required>    
							</div> 	
						</div>

						<div class="col-md-4">

							<div class="form-group">
								<label for="exampleInputEmail1">Whatsapp Barbearia</label>
								<input type="text" class="form-control" id="whatsapp_sistema" name="whatsapp_sistema" placeholder="Whatsapp" value="<?php echo $whatsapp_sistema ?>" required>    
							</div> 	
						</div>
					</div>


					<div class="row">
						
						<div class="col-md-3">

							<div class="form-group">
								<label for="exampleInputEmail1">Tel Fixo Barbearia</label>
								<input type="text" class="form-control" id="telefone_fixo_sistema" name="telefone_fixo_sistema" placeholder="Fixo" value="<?php echo $telefone_fixo_sistema ?>" required>    
							</div> 	
						</div>
						<div class="col-md-7">
							
							<div class="form-group">
								<label for="exampleInputEmail1">Endereço Barbearia</label>
								<input type="text" class="form-control" id="endereco_sistema" name="endereco_sistema" placeholder="Rua X Numero X Bairro Cidade" value="<?php echo $endereco_sistema ?>">    
							</div> 	
						</div>

						<div class="col-md-2">
							<div class="form-group">
								<label for="exampleInputEmail1">Tipo Relatório</label>
								<select class="form-control" name="tipo_rel" id="tipo_rel">
									<option value="PDF" <?php if($tipo_rel == 'PDF'){?> selected <?php } ?> >PDF</option>
									<option value="HTML" <?php if($tipo_rel == 'HTML'){?> selected <?php } ?> >HTML</option>
								</select>   
							</div> 	
						</div>
					</div>


					<div class="row">
						
						<div class="col-md-5">
							<div class="form-group">
								<label for="exampleInputEmail1">Instagram</label>
								<input type="text" class="form-control" id="instagram_sistema" name="instagram_sistema" placeholder="Link do Perfil no Instagram" value="<?php echo $instagram_sistema ?>">   
							</div> 	
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Mensagem Agendamento</label>
								<select class="form-control" name="msg_agendamento" id="msg_agendamento">
									<option value="Sim" <?php if($msg_agendamento == 'Sim'){?> selected <?php } ?> >Sim</option>
									<option value="Não" <?php if($msg_agendamento == 'Não'){?> selected <?php } ?> >Não</option>
									<option value="Api" <?php if($msg_agendamento == 'Api'){?> selected <?php } ?> >Api Paga</option>
								</select>      
							</div> 
						</div>



						<div class="col-md-2">
							<div class="form-group">
								<label for="exampleInputEmail1">Token Api</label>
								<input type="text" class="form-control" id="token" name="token" placeholder="Token Api Whatsapp" value="<?php echo @$token ?>">   
							</div> 
						</div>


						<div class="col-md-2">
							<div class="form-group">
								<label for="exampleInputEmail1">Minutos Aviso</label>
								<input type="number" class="form-control" id="minutos_aviso" name="minutos_aviso" placeholder="Alerta Agendamento" value="<?php echo @$minutos_aviso ?>">   
							</div> 
						</div>

					</div>


					<div class="row">
						

						

						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">CNPJ</label>
								 	<input type="text" class="form-control" id="cnpj_sistema" name="cnpj_sistema" value="<?php echo $cnpj_sistema ?>">    
							</div> 
						</div>


						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Cidade</label>
								 	<input type="text" class="form-control" id="cidade_sistema" name="cidade_sistema" value="<?php echo $cidade_sistema ?>" placeholder="Cidade para o contrato">    
							</div> 
						</div>


						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Manter Agendamento Dias</label>
								 	<input type="number" class="form-control" id="agendamento_dias" name="agendamento_dias" value="<?php echo $agendamento_dias ?>" placeholder="Manter no Banco de Dados">    
							</div> 
						</div>


						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Itens Paginação</label>
								 	<input type="number" class="form-control" id="itens_pag" name="itens_pag" value="<?php echo $itens_pag ?>" placeholder="">    
							</div> 
						</div>

						</div>
	

					<br>
					<small><div id="mensagem-config" align="center"></div></small>
				</div>
				<div class="modal-footer">      
					<button type="submit" class="btn btn-primary">Salvar Dados</button>
				</div>
			</form>	

</div>