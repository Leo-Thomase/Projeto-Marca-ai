<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://chatbot.menuia.com/api/create-message',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(
  'appkey' => '858e5764-bb44-4020-8a05-36b083ea6f70',  
  'authkey' => 'A4jaeEg5P343WnaOQT16J311tPyWyucTtzTjDlO7Ai5CGoFwtM', 
  'message' => $id,
  'cancelarAgendamento' => 'true',
  ),
));

$response = curl_exec($curl);

curl_close($curl);
?>




