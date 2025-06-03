<?php
@session_start();
require_once ("verificar.php");
require_once ("../conexao.php");

$pag = 'feriados';

//verificar se ele tem a permissão de estar nessa página
if (@$clientes == 'ocultar') {
	echo "<script>window.location='../index.php'</script>";
	exit();
}
?>




<div class="row top-50">
	<div class="col-md-8 float-esq">
		<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus"
				aria-hidden="true"></i> <span class="esc">Novo Feriado</span></a>
	</div>
	<div class="col-md-3 float-esq">
		<input onkeyup="listarClientes()" class="form-control" type="text" name="buscar" id="buscar"
			placeholder="Buscar Nome ou Telefone" style="border-radius: 5px">
		<input type="hidden" id="pagina">
	</div>
	<div class="col-md-1 float-esq">
		<button onclick="listarClientes()" id="btn-buscar" class="btn btn-primary"><i class="fa fa-search"></i></button>
	</div>

</div>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>






<!-- Modal Inserir-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close"
					style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="data">Data</label>
								<input type="date" class="form-control" id="data" name="data" required>
							</div>
						</div>
					</div>

					<div class="row">


						<input type="hidden" name="id" id="id">

						<br>
						<small>
							<div id="mensagem" align="center"></div>
						</small>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Salvar</button>
					</div>
			</form>


		</div>
	</div>
</div>

<script type="text/javascript">var pag = "<?= $pag ?>"</script>
<script src="js/ajax.js"></script>

<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

<script type="text/javascript">
	$(document).ready(function () {
		listarClientes()
	});

</script>


<script type="text/javascript">

	function listarClientes(pagina) {

		$("#pagina").val(pagina);

		var busca = $("#buscar").val();
		$.ajax({
			url: 'paginas/' + pag + "/listar.php",
			method: 'POST',
			data: { busca, pagina },
			dataType: "html",

			success: function (result) {
				$("#listar").html(result);

			}
		});
	}
</script>


<script type="text/javascript">

	$("#form").submit(function () {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/salvar.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#mensagem').text('');
				$('#mensagem').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {

					$('#btn-fechar').click();

					var pagina = $("#pagina").val();
					listarClientes(pagina)

				} else {

					$('#mensagem').addClass('text-danger')
					$('#mensagem').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});





	function excluir(id) {
		$.ajax({
			url: 'paginas/' + pag + "/excluir.php",
			method: 'POST',
			data: { id },
			dataType: "text",

			success: function (mensagem) {
				if (mensagem.trim() == "Excluído com Sucesso") {
					var pagina = $("#pagina").val();
					listarClientes(pagina)
				} else {
					$('#mensagem-excluir').addClass('text-danger')
					$('#mensagem-excluir').text(mensagem)
				}

			},

		});
	}



	function listarTextoContrato(id) {

		$.ajax({
			url: 'paginas/' + pag + "/texto-contrato.php",
			method: 'POST',
			data: { id },
			dataType: "html",

			success: function (result) {
				nicEditors.findEditor("contrato").setContent(result);
			}
		});
	}




	$("#form-contrato").submit(function () {
		var id_emp = $('#id_contrato').val();
		event.preventDefault();
		nicEditors.findEditor('contrato').saveContent();
		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/salvar-contrato.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#mensagem-contrato').text('');
				$('#mensagem-contrato').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {

					let a = document.createElement('a');
					a.target = '_blank';
					a.href = 'rel/contrato_servico_class.php?id=' + id_emp;
					a.click();

				} else {

					$('#mensagem-contrato').addClass('text-danger')
					$('#mensagem-contrato').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});

</script>