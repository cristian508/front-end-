<?php
session_start();
include('conexao.php');
include('verifica_login.php');

$idCliente = filter_input(INPUT_POST, 'idCliente', FILTER_SANITIZE_STRING);
$idServicos = filter_input(INPUT_POST, 'idServicos', FILTER_SANITIZE_STRING);
$idPrestador = filter_input(INPUT_POST, 'idPrestador', FILTER_SANITIZE_STRING);



$result_solicitacao = "INSERT INTO solicitacao(Client_idcliente, Servicos_idServicos, Prestador_idPrestador, data) VALUES ('$idCliente','$idServicos','$idPrestador', NOW())";
$resultado_solicitacao = mysqli_query($conexao, $result_solicitacao);

echo $result_solicitacao;
echo $resultado_solicitacao;


#if(mysqli_insert_id($conexao)){
#	$_SESSION['msg'] = "<p style='color:green;'>Solicitação finalizada com sucesso</p>";
#	header("Location: prestador.php");
#}else{
#	$_SESSION['msg'] = "<p style='color:red;'>Erro ao finalizar a solicitação</p>";
#	header("Location: prestador.php");
#}
