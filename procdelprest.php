<?php
session_start();
include_once("conexao.php");
$idPrest = filter_input(INPUT_GET, 'idPrestador', FILTER_SANITIZE_NUMBER_INT);
if(!empty($idPrest)){
$result_prestador = "DELETE FROM prestador WHERE idPrestador='$idPrest'";
$resultado_prestador = mysqli_query($conexao, $result_prestador);
if(mysqli_affected_rows($conexao)){
	$_SESSION['msg'] = "<p style='color:green;'>Usuário excluido com sucesso</p>";
	header("Location: prestador.php");
}else{
	$_SESSION['msg'] = "<p style='color:red;'>Usuário não excluido com sucesso</p>";
	header("Location: prestador.php?idPrestador=$$idPrest");
}
}else{
	$_SESSION['msg'] = "<p style='color:red;'>Selecione um usuário</p>";
	header("Location: prestador.php?idPrestador=$idPrest");
}