<?php require_once("sistema/conexao.php") ?>

<html>

<head>
  <!-- Basic -->
   <link rel="manifest" href="images/site.webmanifest">
 
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="keywords" content="Studio NeyMarques" />
  <meta name="description" content="Barba, cabelo e bigode é aqui!!" />
  <meta name="author" content="Higor Barreto" />
  
  <!-- Ícones para tela inicial -->
  <link rel="apple-touch-icon" sizes="180x180" href="images/<?php echo $icone_site ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="images/<?php echo $icone_site ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="images/<?php echo $icone_site ?>">

  <meta content='yes' name='apple-mobile-web-app-capable' />
  <meta content='yes' name='mobile-web-app-capable' />
  <meta name="apple-mobile-web-app-status-bar" content="#aa7700">
  <meta name="theme-color" content="black">
  <link rel="apple-touch-icon" href="assets/logos/icon-192x192-apple.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $nome_sistema ?></title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
  <div class="hero_area">
    <div class="hero_bg_box" style="background-color:#000000">
      <!--<img src="images/<?php echo $img_banner_index ?>" alt="">-->

    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand " href="index"> <?php echo $nome_sistema ?> </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="index">Home <span class="sr-only">(current)</span></a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="agendamentos"> Agendamentos</a>
              </li>           
              <li class="nav-item">
                <a class="nav-link" href="produtos">Produtos</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="servicos">Serviços</a>
              </li>
             
               <li class="nav-item">
                <a title="Ver Instagram" class="nav-link" href="<?php echo $instagram_sistema ?>" target="_blank"> <i class="fa fa-instagram" aria-hidden="true"></i> </a>
              </li>

                <li  class="nav-item">
                <a title="Ir para o Whatsapp" class="nav-link" href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $tel_whatsapp ?>" target="_blank"> <i class="fa fa-whatsapp" aria-hidden="true"></i> </a>
              </li>

                <li class="nav-item">
                <a title="Ir para o Sistema" class="nav-link" href="sistema" target="_blank"> <i class="fa fa-user" aria-hidden="true"></i> </a>
              </li>
             
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
	
</html>