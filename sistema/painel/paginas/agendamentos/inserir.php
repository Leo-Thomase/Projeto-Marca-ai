<?php 
$tabela = 'agendamentos';
require_once("../../../conexao.php");

@session_start();
$usuario_logado = @$_SESSION['id'].'';

$cliente = $_POST['cliente'];
$data = $_POST['data'];
$hora = @$_POST['hora'];
$obs = $_POST['obs'];
$id = $_POST['id'];
$funcionario = $_POST['funcionario'];
$servico = $_POST['servico'];
$data_agd = $_POST['data'];
$hash = '';

$random_bytes = random_bytes(10);  // 10 bytes geram 20 caracteres hexadecimais

// Converter os bytes para uma string hexadecimal
$hash = bin2hex($random_bytes);

if(@$hora == ""){
	echo 'Selecione um Horário antes de agendar!';
	exit();
}

$diasemana = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sabado");
$diasemana_numero = date('w', strtotime($data));
$dia_procurado = $diasemana[$diasemana_numero];

//percorrer os dias da semana que ele trabalha
$query = $pdo->query("SELECT * FROM dias where funcionario = '$funcionario' and dia = '$dia_procurado'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) == 0){
		echo 'Este Funcionário não trabalha neste Dia!';
	exit();
}



$dataF = implode('/', array_reverse(explode('-', $data)));
$horaF = date("H:i", strtotime($hora));

//validar horario
$query = $pdo->query("SELECT * FROM $tabela where data = '$data' and hora = '$hora' and funcionario = '$funcionario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Este horário não está disponível!';
	exit();
}





//pegar nome do cliente
$query = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cliente = $res[0]['nome'];
$telefone = $res[0]['telefone'];

if($not_sistema == 'Sim'){
	$mensagem_not = $nome_cliente;
	$titulo_not = 'Novo Agendamento '.$dataF.' - '.$horaF;
	$id_usu = $funcionario;
	require('../../../../api/notid.php');
} 

$msg_agendamento = 'Api';

if($msg_agendamento == 'Api'){

//agendar o alerta de confirmação
$hora_atual = date('H:i:s');
$data_atual = date('Y-m-d');
$hora_minutos = strtotime("-$minutos_aviso minutes", strtotime($hora));
$nova_hora = date('H:i:s', $hora_minutos);

$telefone = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

if(strtotime($hora_atual) < strtotime($nova_hora) or strtotime($data_atual) != strtotime($data_agd)){
	$mensagem = '*Confirmação de Agendamento* %0A %0A';
	$mensagem .= 'Envie *Sim* para confirmar seu agendamento hoje às '.$horaF;
	$data_mensagem = $data_agd.' '.$nova_hora;
	if($minutos_aviso > 0){
		require('../../../../ajax/api-agendar.php');
	}
	
}

}


$query = $pdo->prepare("INSERT INTO $tabela SET funcionario = '$funcionario', cliente = '$cliente', hora = '$hora', data = '$data_agd', usuario = '$usuario_logado', status = 'Agendado', obs = :obs, data_lanc = curDate(), servico = '$servico', hash = '$hash'");

$query->bindValue(":obs", "$obs");
$query->execute();


echo 'Salvo com Sucesso'; 

?>