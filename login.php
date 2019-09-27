<?php
session_start();
include('conexao.php');

if(empty($_POST['cpf']) || empty($_POST['senha'])) {
	header('Location: index.php');
	exit();
}

$cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select * from cliente where cpf = '{$cpf}' and senha = md5('{$senha}')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
	$cpf_bd = mysqli_fetch_assoc($result);
	$_SESSION['nome'] = $cpf_bd['nome'];
	header('Location: painel.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}