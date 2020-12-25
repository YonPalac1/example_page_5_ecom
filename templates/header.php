<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
	<?php require_once "scripts/scrips.php"?>

	<link rel="stylesheet" type="text/css" href="css/styleInicio.css">
</head>
<style type="text/css">
    .slide{
      background-image: url(img/bg.png);
      background-size: cover;
      background-position: top;
      height: 300px;
      max-width: 1150px;
    }
</style>
<body class="bg-light">
<!---------------------NAVBAR---------------------------------------->
<div class="container-fluid bg-dark  text-center">
  <nav class="navbar navbar-expand-lg navbar-light navbar-dark bg-dark container">
      <a class="navbar-brand" href="index.php"><i class="fas fa-rocket" style="font-size: 50px"></i>Rocket <br>Market</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <div class="navbar-nav ml-auto">
      <a class="nav-link text-white" href="index.php">HOME</a>
      <a class="nav-link" href="#">PERFIL</a>
      <a class="nav-link" href="#">Contacto</a>
      <a class="nav-link" href="#">Configuracion</a>
    </div>
  </div>
  </nav>
</div>

<div class="container-fluid bg-light  text-center">
  <nav class="navbar navbar-expand-lg navbar-light container sNav">
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bars"></i></button>
      Categorias
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <div class="navbar-nav ml-auto">
      <a class="nav-link active btn btn-primary text-white" href="mostrarCarrito.php">CARRITO(<?php 
            echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);
          ?>)<i class="fas fa-cart-arrow-down ml-3"></i></a>
      <a class="nav-link" href="#">Bolsa<i class="fas fa-shopping-bag ml-3"></i></a>
    </div>
  </div>
  </nav>
</div>
<!---------------------NAVBAR---------------------------------------->
<!---------------------header---------------------------------------->

<div class="container-fluid slider d-flex flex-column justify-content-center align-items-center slide p-5">
    <div class="col-12 text-center p-5">
      <h3 class="text-info">Carrito de compras hecha con PHP</h3>
      <h4 class="text-light">con PayPal integrado</h4>
    </div>
</div>
<!---------------------header---------------------------------------->
<!---------------------menu------------------------------------->
<main class="container mt-1">