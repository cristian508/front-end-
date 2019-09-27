<?php
session_start();
include("conexao.php");

$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
$cel = mysqli_real_escape_string($conexao, trim($_POST['cel']));
$senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senha'])));


$sql = "select count(*) as total from cliente where cpf = '$cpf'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1) {
	$_SESSION['usuario_existe'] = true;
	header('Location: cadastro.php');
	exit;
}

$sql = "INSERT INTO cliente (nome, cpf, cel, senha, data) VALUES ('$nome', '$cpf', '$cel', '$senha', NOW())";

if($conexao->query($sql) === TRUE) {
	$_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Location: cadastro.php');
exit;
?>