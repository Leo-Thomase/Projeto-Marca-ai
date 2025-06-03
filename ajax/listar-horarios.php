<?php 
require_once("../sistema/conexao.php");
@session_start();
$usuario = @$_SESSION['id'];

$funcionario = @$_POST['funcionario'];
$data = @$_POST['data'];
$hora_rec = @$_POST['hora'];

$hoje = date('Y-m-d');
$hora_atual = date('H:i:s');

if(strtotime($data) < strtotime($hoje)){
	echo '000';
	exit();
}

if($funcionario == ""){
	
	exit();
}



$diasemana = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sabado");
$diasemana_numero = date('w', strtotime($data));
$dia_procurado = $diasemana[$diasemana_numero];



//percorrer os dias da semana que ele trabalha
$query = $pdo->query("SELECT * FROM dias where funcionario = '$funcionario' and dia = '$dia_procurado'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) == 0 and $data <> '2024-12-02' and $data <> '2024-12-09' and $data <> '2024-12-16' and $data <> '2024-12-23' and  $data <> '2024-12-30'){
		echo 'Este Funcionário não trabalha neste Dia!';
	exit();
}

$query = $pdo->query("SELECT * FROM feriados where data = '$data'");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($result) > 0){
		echo 'Este Funcionário não trabalha neste Dia!';
	exit();
}


$query = $pdo->query("SELECT * FROM horarios where funcionario = '$funcionario' ORDER BY horario asc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	
	if($total_reg > 0){
		for($i=0; $i < $total_reg; $i++){
				$hora = $res[$i]['horario'];
				$horaF = date("H:i", strtotime($hora));
				$dataH = $res[$i]['data'];}}




$query5 = $pdo->query("SELECT * FROM agendamentos where data = '$data' and funcionario = '$funcionario'");
$res9 = $query5->fetchAll(PDO::FETCH_ASSOC);
if(@count($res9) == 13){
		echo 'Todos os horários deste dia indisponíveis!';
	exit();
}

?>
<div class="row">
    <?php 
    $query = $pdo->query("SELECT * FROM horarios where funcionario = '$funcionario' ORDER BY horario asc");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);

    $horarios_disponiveis = false; // Flag para verificar se há horários disponíveis

    if ($total_reg > 0) {
        for ($i = 0; $i < $total_reg; $i++) {
            foreach ($res[$i] as $key => $value){}
                $hora = $res[$i]['horario'];
                $horaF = date("H:i", strtotime($hora));
                $dataH = $res[$i]['data'];

                // Validar horario
                $query2 = $pdo->query("SELECT * FROM agendamentos where data = '$data' and hora = '$hora' and funcionario = '$funcionario'");
                $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                $total_reg2 = @count($res2);

                // Verificar se o horário é anterior à hora atual e o dia é hoje
                if (strtotime($hora) < strtotime($hora_atual) and strtotime($data) == strtotime($hoje)) {
                    continue; // Pular para a próxima iteração
                }

                // Verificar se não há agendamentos ou se o horário enviado é igual ao horário atual
                if ($total_reg2 == 0 || strtotime($hora_rec) == strtotime($hora)) {
                    $hora_agendada = '';
                    $texto_hora = '';

                    if (strtotime($hora_rec) == strtotime($hora)) {
                        $checado = 'checked';
                    } else {
                        $checado = '';
                    }

                    if (strtotime($hora) < strtotime($hora_atual) and strtotime($data) == strtotime($hoje)) {
                        $esconder = 'disabled';
                    } else {
                        $esconder = '';
                    }

                    if (strtotime($dataH) != strtotime($data) and $dataH != "" and $dataH != "null") {
                        continue; // Pular para a próxima iteração
                    }
                    ?>

                    <div class="col-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hora" value="<?php echo $hora ?>" <?php echo $hora_agendada ?> style="width:17px; height: 17px" required <?php echo $checado ?> <?php echo $esconder ?>>
                            <label class="form-check-label <?php echo $texto_hora ?>" for="flexRadioDefault1">
                                <?php echo $horaF ?>
                            </label>
                        </div>
                    </div> 

                    <?php 
                    $horarios_disponiveis = true; // Marcar que há horários disponíveis
                }
            }
        }
  

    // Verificar se não há horários disponíveis e exibir mensagem correspondente
    if (!$horarios_disponiveis) {
        ?>
        <div class="col-12">
            <p>Todos os horários deste dia indisponíveis!</p>
        </div>
        <?php
    }
    ?>
</div>


