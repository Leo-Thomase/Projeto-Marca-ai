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

					<div class="col-md-5">
						<div class="form-group">
								<label for="exampleInputEmail1">Mapa Site <small>(Url incorporada)</small></label>
								<input type="text" class="form-control" id="mapa" name="mapa" placeholder="" value='<?php echo $mapa ?>'>  
							</div> 	
						</div>

						


						
					</div>

					<div class="row">
						<div class="col-md-12">
						<div class="form-group">
								<label for="exampleInputEmail1">Texto Rodapé Site <small>(255) Caracteres</small></label>
								<input maxlength="255" type="text" class="form-control" id="texto_rodape" name="texto_rodape" placeholder="Texto para o Rodapé do site" value="<?php echo $texto_rodape ?>">   
							</div> 
						</div>
					</div>


					<div class="row">
						<div class="col-md-12">
						<div class="form-group">
								<label for="exampleInputEmail1">Texto Sobre (Site) <small>(600) Caracteres</small></label>
								<input maxlength="255" type="text" class="form-control" id="texto_sobre" name="texto_sobre" placeholder="Texto para a área Sobre a empresa no site" value="<?php echo $texto_sobre ?>">   
							</div> 
						</div>
					</div>


					<div class="row">
						<div class="col-md-12">
						<div class="form-group">
								<label for="exampleInputEmail1">Texto Cartão Fidelidade</label>
								<input maxlength="255" type="text" class="form-control" id="texto_fidelidade" name="texto_fidelidade" placeholder="Parabéns, você completou seus cartões, você ganhou ..." value="<?php echo @$texto_fidelidade ?>">   
							</div> 
						</div>

						
					</div>

					<div class="row">
						<div class="col-md-3">
						<div class="form-group">
								<label for="exampleInputEmail1">Cartões Troca</label>
								<input type="number" class="form-control" id="quantidade_cartoes" name="quantidade_cartoes" placeholder="Quantidade Cartões Troca" value="<?php echo $quantidade_cartoes ?>">   
							</div> 
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Mensagem Agendamento</label>
								<select class="form-control" name="msg_agendamento" id="msg_agendamento">
									<option value="Sim" <?php if($msg_agendamento == 'Sim'){?> selected <?php } ?> >Sim</option>
									<option value="Não" <?php if($msg_agendamento == 'Não'){?> selected <?php } ?> >Não</option>

								</select>      
							</div> 
						</div>

						
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">CNPJ</label>
								 	<input type="text" class="form-control" id="cnpj_sistema" name="cnpj_sistema" value="<?php echo $cnpj_sistema ?>">    
							</div> 
						</div>

					</div>


					<div class="row">
						

						



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
					



				

						<div class="row">

							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Logo (*PNG)</label> 
									<input class="form-control" type="file" name="foto-logo" onChange="carregarImgLogo();" id="foto-logo">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImg">
									<img src="../img/<?php echo $logo_sistema ?>"  width="80px" id="target-logo">									
								</div>
							</div>


							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Ícone (*Png)</label> 
									<input class="form-control" type="file" name="foto-icone" onChange="carregarImgIcone();" id="foto-icone">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImg">
									<img src="../img/<?php echo $icone_sistema ?>"  width="50px" id="target-icone">									
								</div>
							</div>

						</div>



						<div class="row">

							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Logo Relatório (*Jpg)</label> 
									<input class="form-control" type="file" name="foto-logo-rel" onChange="carregarImgLogoRel();" id="foto-logo-rel">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImg">
									<img src="../img/<?php echo $logo_rel ?>"  width="80px" id="target-logo-rel">									
								</div>
							</div>



							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Ícone Site (*png)</label> 
									<input class="form-control" type="file" name="foto-icone-site" onChange="carregarImgIconeSite();" id="foto-icone-site">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImg">
									<img src="../../images/<?php echo $icone_site ?>"  width="50px" id="target-icone-site">									
								</div>
							</div>



						</div>



						<div class="row">

							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Imagem Área Sobre (Site)</label> 
									<input class="form-control" type="file" name="foto-sobre" onChange="carregarImgSobre();" id="foto-sobre">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImg">
									<img src="../../images/<?php echo $imagem_sobre ?>"  width="80px" id="target-sobre">									
								</div>
							</div>



							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Imagem Banner Index <small>(1500x1000)</small></label> 
									<input class="form-control" type="file" name="foto-banner-index" onChange="carregarImgBannerIndex();" id="foto-banner-index">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImg">
									<img src="../../images/<?php echo $img_banner_index ?>"  width="80px" id="target-banner-index">									
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