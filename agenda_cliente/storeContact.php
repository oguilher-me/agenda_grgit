<?php

$service_url = 'http://localhost:8001/contact';
$curl = curl_init($service_url);

$curl_post_data = http_build_query($_POST);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('Não foi possível realizar a requisição. ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);

if (isset($decoded->status) && $decoded->status == false) {
    die('Não foi possível realizar a requisição.: ' . $decoded->message);
}

header('Location: listar.php');