<?php
require_once("C:/xampp/htdocs/neymarques/sistema/conexao.php");
// Dados de envio
@session_start();
$data = array(
    'appkey' => '858e5764-bb44-4020-8a05-36b083ea6f70',  // Sua chave de aplicação
    'authkey' => 'A4jaeEg5P343WnaOQT16J311tPyWyucTtzTjDlO7Ai5CGoFwtM',  // Sua chave de autenticação
    'to' => $telefone,  // Número do destinatário (ou id de grupo), substitua por um número válido
    'message' => $mensagem,  // A mensagem a ser enviada
    'agendamento' => $data_mensagem,  // Data e hora do agendamento
    'file' => '',  // URL de um arquivo multimídia (opcional)
    'nomearquivo' => '',  // Nome do arquivo (opcional)
);

// Inicia a sessão cURL
$curl = curl_init();

// Configura a requisição cURL
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://chatbot.menuia.com/api/create-message',  // URL da API
    CURLOPT_RETURNTRANSFER => true,  // Para retornar a resposta da requisição
    CURLOPT_ENCODING => '',  // Para permitir qualquer tipo de codificação de resposta
    CURLOPT_MAXREDIRS => 10,  // Limite de redirecionamentos
    CURLOPT_TIMEOUT => 0,  // Timeout da requisição (0 significa sem limite)
    CURLOPT_FOLLOWLOCATION => true,  // Seguir redirecionamentos
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,  // Usar HTTP 1.1
    CURLOPT_CUSTOMREQUEST => 'POST',  // Definir o método como POST
    CURLOPT_POSTFIELDS => $data,  // Passar os dados da requisição
));

// Executa a requisição cURL
$response = curl_exec($curl);

// Verifica se ocorreu algum erro durante a requisição
if ($response === false) {
    // Insere o agendamento sem passar o ID
    $query = $pdo->prepare("INSERT INTO agendamentos SET funcionario = :funcionario, cliente = :cliente, hora = :hora, data = :data, usuario = '0', status = 'Agendado', obs = :obs, data_lanc = curDate(), servico = :servico, hash = :hash");
    $query->bindValue(":funcionario", $funcionario);
    $query->bindValue(":cliente", $id_cliente);
    $query->bindValue(":hora", $hora);
    $query->bindValue(":data", $data_agd);
    $query->bindValue(":servico", $servico);
    $query->bindValue(":hash", $hash); // Ajuste o hash conforme necessário
    $query->execute();
} else {
    // Decodifica a resposta da API (assumindo que a resposta está em JSON)
    $response_data = json_decode($response, true);

    if (isset($response_data['id'])) {
        // Se o ID estiver na resposta, faz o insert com o ID
        $id = $response_data['id'];
        $query = $pdo->prepare("INSERT INTO agendamentos SET id = :id, funcionario = :funcionario, cliente = :cliente, hora = :hora, data = :data, usuario = '0', status = 'Agendado', data_lanc = curDate(), servico = :servico, hash = :hash");
        $query->bindValue(":id", $id);
        $query->bindValue(":funcionario", $funcionario);
        $query->bindValue(":cliente", $id_cliente);
        $query->bindValue(":hora", $hora);
        $query->bindValue(":data", $data_agd);
        $query->bindValue(":servico", $servico);
        $query->bindValue(":hash", $id);
        $query->execute();
    } else {
        // Se o ID não for encontrado na resposta, faz o insert sem o ID
        $query = $pdo->prepare("INSERT INTO agendamentos SET funcionario = :funcionario, cliente = :cliente, hora = :hora, data = :data, usuario = '0', status = 'Agendado', data_lanc = curDate(), servico = :servico");
        $query->bindValue(":funcionario", $funcionario);
        $query->bindValue(":cliente", $id_cliente);
        $query->bindValue(":hora", $hora);
        $query->bindValue(":data", $data_agd);
        $query->bindValue(":servico", $servico);
        $query->execute();
    }
}

// Fecha a conexão cURL
curl_close($curl);
?>
