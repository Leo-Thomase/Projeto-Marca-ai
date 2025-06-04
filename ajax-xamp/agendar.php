<?php 
require_once("../sistema/conexao.php");
@session_start();
$telefone = $_POST['telefone'];
$nome = $_POST['nome'];
$funcionario = $_POST['funcionario'];
$hora = @$_POST['hora'];
$servico = $_POST['servico'];
$data = $_POST['data'];
$data_agd = $_POST['data'];
$id = @$_POST['id'];


@$_SESSION['telefone'] = $telefone;

if($hora == ""){
	echo 'Escolha um Horário para Agendar!';
	exit();
}

if($data < date('Y-m-d')){
	echo 'Escolha uma data igual ou maior que Hoje!';
	exit();
}

//validar horario
$query = $pdo->query("SELECT * FROM agendamentos where data = '$data' and hora = '$hora' and funcionario = '$funcionario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Este horário não está disponível!';
	exit();
}

//Cadastrar o cliente caso não tenha cadastro
$query = $pdo->query("SELECT * FROM clientes where telefone LIKE '$telefone' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) == 0){
	$query = $pdo->prepare("INSERT INTO clientes SET nome = :nome, telefone = :telefone, data_cad = curDate(), cartoes = '0', alertado = 'Não'");

	$query->bindValue(":nome", "$nome");
	$query->bindValue(":telefone", "$telefone");	
	$query->execute();
	$id_cliente = $pdo->lastInsertId();

}else{
	$id_cliente = $res[0]['id'];
}



$dataF = implode('/', array_reverse(explode('-', $data)));
$horaF = date("H:i", strtotime($hora));

if($not_sistema == 'Sim'){
	$mensagem_not = $nome;
	$titulo_not = 'Novo Agendamento '.$dataF.' - '.$horaF;
	$id_usu = $funcionario;
	require('../api/notid.php');
} 


if($msg_agendamento == 'Api'){

$query = $pdo->query("SELECT * FROM usuarios where id = '$funcionario' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_func = $res[0]['nome'];

$query = $pdo->query("SELECT * FROM servicos where id = '$servico' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_serv = $res[0]['nome'];

$dataF = implode('/', array_reverse(explode('-', $data)));
$horaF = date("H:i", strtotime($hora));

$mensagem = '_Novo Agendamento_ ' . PHP_EOL;
$mensagem .= 'Serviço: *'.$nome_serv.'* ' . PHP_EOL;
$mensagem .= 'Data: *'.$dataF.'* ' . PHP_EOL;
$mensagem .= 'Hora: *'.$horaF.'* ' . PHP_EOL;


$telefone = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

require('api-texto.php');


//agendar o alerta de confirmação
$hora_atual = date('H:i:s');
$data_atual = date('Y-m-d');
$hora_minutos = strtotime("-$minutos_aviso minutes", strtotime($hora));
$nova_hora = date('H:i:s', $hora_minutos);

if(strtotime($hora_atual) < strtotime($nova_hora) or strtotime($data_atual) != strtotime($data_agd)){
	$mensagem = '*Lembrete de Agendamento* ' . PHP_EOL . PHP_EOL;
	$mensagem .= 'Seu agendamento é hoje às ' . $horaF . PHP_EOL;
	$mensagem .= '. Caso não possa comparecer, por favor cancele no site.' . PHP_EOL;
	$data_mensagem = $data_agd.' '.$nova_hora;
	if($minutos_aviso > 0){
		require('api-agendar.php');
	}
	
}
}


echo 'Agendado com Sucesso';


?>