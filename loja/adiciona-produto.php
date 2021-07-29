<?php
require_once("logica-usuario.php");
verificaUsuario();
require_once("cabecalho.php"); 		
require_once("banco-produto.php"); 

$nome = $_POST['nome'];
$preco = $_POST['preco'];
$descricao = $_POST['descricao'];
$categoria_id = $_POST['categoria_id'];
if(array_key_exists('usado', $_POST)) {
	$usado = "true";
} else {
	$usado = "false";
}

if(insereProduto($conexao, $nome, $preco, $descricao, $categoria_id, $usado)) { ?>
	<script>
	window.location.replace("produto-lista.php");
	</script>
<?php
}
?>

<?php include("rodape.php"); ?>			
