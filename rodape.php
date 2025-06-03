<?php require_once("sistema/conexao.php") ?>
<!-- footer section -->
<footer class="footer_section">
  <div class="container">
    <div class="footer_content ">
      <!--footer-->
      <div class="footer" align="center" style="background: black;">
        <hr size="2" color="#ffffff" width="50%" align="center">
        <p> Desenvolvido por <a style="color: white" href="https://www.instagram.com/_higorcamillo/"
            target="_blank">Marca Ai</a></p>
      </div>
      <!--//footer-->
    </div>

  </div>

</footer>
<!-- footer section -->

<!-- jQery -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- owl slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
<!-- Google Map -->
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
<!-- End Google Map -->

<!-- Mascaras JS -->
<script type="text/javascript" src="sistema/painel/js/mascaras.js"></script>

<!-- Ajax para funcionar Mascaras JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>


</body>

</html>


<script type="text/javascript">

  $("#form_cadastro").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      url: 'ajax/cadastrar.php',
      type: 'POST',
      data: formData,

      success: function (mensagem) {
        $('#mensagem-rodape').text('');
        $('#mensagem-rodape').removeClass()
        if (mensagem.trim() == "Salvo com Sucesso") {
          //$('#mensagem-rodape').addClass('text-success')
          $('#mensagem-rodape').text(mensagem)

        } else {

          //$('#mensagem-rodape').addClass('text-danger')
          $('#mensagem-rodape').text(mensagem)
        }


      },

      cache: false,
      contentType: false,
      processData: false,

    });

  });


</script>