<?php 
require_once("../../sistema/conexao.php");
$tabela = 'receber';

$id_usuario = $_POST['id_usuario'];
$id = $_POST['id'];



$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$funcionario = $res[0]['funcionario'];
$servico = $res[0]['servico'];
$cliente = $res[0]['pessoa'];
$descricao = 'Comissão - '.$res[0]['descricao'];
$tipo = $res[0]['tipo'];

if($tipo == 'Serviço'){
	$query = $pdo->query("SELECT * FROM servicos where id = '$servico'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$valor = $res[0]['valor'];


$pdo->query("UPDATE $tabela SET pago = 'Sim', usuario_baixa = '$id_usuario', data_pgto = curDate() where id = '$id'");

echo 'Baixado com Sucesso';
} ?>