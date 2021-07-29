<?php
require_once("logica-usuario.php");
verificaUsuario();
require_once("cabecalho.php"); 		
require_once("banco-produto.php"); 


 $id = $_POST['id'];
 removeProduto($conexao, $id);
?> <script>
 window.location.replace("produto-lista.php");
 </script>
