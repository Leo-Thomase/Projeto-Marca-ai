<?php
$curl = curl_init();

// Defina a URL da API para enviar a mensagem
$url = 'https://chatbot.menuia.com/api/create-message';

$post_data = array(
       'appkey' => '858e5764-bb44-4020-8a05-36b083ea6f70',  // Sua chave de aplicação
    'authkey' => 'A4jaeEg5P343WnaOQT16J311tPyWyucTtzTjDlO7Ai5CGoFwtM',
    'sandbox' => 'false',
    'to' => $telefone,
    'message' => $mensagem
);

$options = array(
    'http' => array(
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($post_data)
    )
);

// Configure o cURL
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,  // Definir a URL da API
    CURLOPT_RETURNTRANSFER => true,  // Para retornar a resposta em vez de exibi-la diretamente
    CURLOPT_ENCODING => '',  // Para permitir qualquer tipo de codificação de resposta
    CURLOPT_MAXREDIRS => 10,  // Limite de redirecionamentos
    CURLOPT_TIMEOUT => 0,  // Timeout de requisição (0 significa sem limite)
    CURLOPT_FOLLOWLOCATION => true,  // Seguir redirecionamentos
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,  // Usar HTTP 1.1
    CURLOPT_CUSTOMREQUEST => 'POST',  // Definir o método como POST
    CURLOPT_POSTFIELDS => $post_data,  // Enviar os dados como um array
));

// Executar a requisição
$response = curl_exec($curl);

// Fechar a conexão cURL
curl_close($curl);
?>
