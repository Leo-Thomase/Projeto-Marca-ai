<?php 
require_once("../../../conexao.php");
$tabela = 'feriados';

$id = $_POST['id'];
$data = $_POST['data'];


//validar email
$query = $pdo->query("SELECT * from $tabela where data = '$data'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0 and $id != $res[0]['id']){
	echo 'Data já Cadastrado, escolha outro!!';
	exit();
}


if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET data = :data");
}else{
	$query = $pdo->prepare("UPDATE $tabela SET data = :data WHERE id = '$id'");
}

$query->bindValue(":data", "$data");
$query->execute();

echo 'Salvo com Sucesso';
 ?>