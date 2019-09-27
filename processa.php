<?php
session_start();
include("conexao.php");
include('verifica_login.php');

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
$coren = filter_input(INPUT_POST, 'coren', FILTER_SANITIZE_STRING);
$cel = filter_input(INPUT_POST, 'cel', FILTER_SANITIZE_STRING);


$result_prestador = "INSERT INTO prestador(nome, cpf, coren, cel, status, data) VALUES ('$nome','$cpf','$coren','$cel','1', NOW())";
$resultado_prestador = mysqli_query($conexao, $result_prestador);

if(mysqli_insert_id($conexao)){
	$_SESSION['msg'] = "<p style='color:green;'>Prestador cadastrado com sucesso</p>";
	header("Location: prestador.php");
}else{
	$_SESSION['msg'] = "<p style='color:red;'>Prestador não foi cadastrado com sucesso</p>";
	header("Location: prestador.php");
}
