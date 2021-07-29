<?php
error_reporting(E_ALL ^ E_NOTICE);
  require_once("mostra-alerta.php"); ?>
<html>
<head>
	<meta charset="utf-8">
	<title>Minha Loja</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/loja.css" rel="stylesheet">
</head>
<body>
	
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div>
				<ul class="nav navbar-nav">
					<li><a href="index.php">Adiciona Produto</a></li>
					<li><a href="produto-lista.php">Produtos</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	
	<div class="container">
		<div class="principal">
		    <?php  mostraAlerta("success"); ?>
		    <?php mostraAlerta("danger"); ?>
			
