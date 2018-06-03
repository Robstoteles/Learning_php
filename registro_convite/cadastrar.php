<?php
/*
	Para que o usuário consiga se cadastrar no sistema
	O mesmo precisa receber um link convidando-o
	O link contém um código, e através deste código é feito o cadastro
*/
session_start();
require 'config.php';
//Verificando se o código não está vazio
if(!empty($_GET['codigo'])) {
	$codigo = strip_tags(addslashes($_GET['codigo']));
	//Se houver o código na url, então verifica se o código existe com o sql abaixo
	$sql = "SELECT * FROM usuarios WHERE codigo = '$codigo'";
	$sql = $pdo->query($sql);
	//Se não houver um código compatível com o da url, redireciona para a tela de login
	if($sql->rowCount() == 0) {
		header("Location: login.php");
		exit;
	}
} else {
	//Se a url não possuir um código, redireciona para a tela de login
	header("Location: login.php");
	exit;
}
//Se o campo email estiver preenchido
if(!empty($_POST['email'])) {
	$email = strip_tags(addslashes($_POST['email']));
	$senha = md5(strip_tags(addslashes($_POST['senha'])));
	//Consulta na tabela o email fornecido no input
	$sql = "SELECT * FROM usuarios WHERE email = '$email'";
	$sql = $pdo->query($sql);

	if($sql->rowCount() <= 0) {
		//Gerando um código aletório sem repetição
		$codigo = md5(rand(0,99999).rand(0,99999));
		$sql = "INSERT INTO usuarios (email, senha, codigo) VALUES ('$email', '$senha', '$codigo')";
		$sql = $pdo->query($sql);

		unset($_SESSION['logado']);

		header("Location: index.php");
		exit;
	}
}
?>
<h3>Cadastrar</h3>

<form method="POST">
	E-mail:<br/>
	<input type="email" name="email" /><br/><br/>

	Senha:<br/>
	<input type="password" name="senha" /><br/><br/>

	<input type="submit" value="Cadastrar" />
</form>
