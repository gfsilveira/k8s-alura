<?php 
require_once ("banco-usuario.php");
require_once("logica-usuario.php");

$usuario = buscaUsuario($conexao, $_POST["email"], $_POST["senha"]);
if($usuario == null) {

} else {
	logaUsuario($usuario["email"]);
}
