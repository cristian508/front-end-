<?php
session_start();
include_once("conexao.php");
include("verifica_login.php");

$idPrest = filter_input(INPUT_POST, 'idPrestador', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
$coren = filter_input(INPUT_POST, 'coren', FILTER_SANITIZE_STRING);
$cel = filter_input(INPUT_POST, 'cel', FILTER_SANITIZE_STRING);


$result_prestador = "UPDATE prestador SET nome='$nome', cpf='$cpf', coren='$coren', cel='$cel', status='1', data=NOW() WHERE idPrestador='$idPrest'";
$resultado_prestador = mysqli_query($conexao, $result_prestador);

if(mysqli_affected_rows($conexao)){
	$_SESSION['msg'] = "<p style='color:green;'>Usuário editado com sucesso</p>";
	header("Location: prestador.php");
}else{
	$_SESSION['msg'] = "<p style='color:red;'>Usuário não foi editado com sucesso</p>";
	header("Location: editar.php?idPrestador=$idPrest");
}
