<?php 
require_once("../sistema/conexao.php");

$serv = $_POST['serv'];

$query = $pdo->query("SELECT * FROM servicos_func where servico = '$serv' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	for($i=0; $i < @count($res); $i++){
		$func = $res[$i]['funcionario'];

		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$func' and ativo = 'Sim' ");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);	
		$nome_func = $res2[$i]['nome'];

		echo '<option value="'.$func.'">'.$nome_func.'</option>';
	}		
}


?>

