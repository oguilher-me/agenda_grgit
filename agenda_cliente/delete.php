<?php

$service_url = 'http://localhost:8001/contact/';
$ch = curl_init($service_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

$curl_post_data = array('id' => $_GET['id']);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curl_post_data));

$response = curl_exec($ch);

if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('Não foi possível realizar a requisição. ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->status) && $decoded->status == false) {
    die('Não foi possível realizar a requisição: ' . $decoded->errormessage);
}

header('Location: listar.php');
