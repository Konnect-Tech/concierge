<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$token = $_POST['token'];
$secret_key = $_POST['secret_key'];
$secret_iv = $_POST['secret_iv'];
if(!$token || !$secret_key || !$secret_iv){
	echo json_encode(["result_code" => -1, "message" => "\"token\" parameter is required."], JSON_UNESCAPED_UNICODE);
	exit;
}

$parse = jwt_decrypt($token, $secret_key, $secret_iv);
if(!isset($parse['result_state'])){
	echo json_encode(["result_code" => -1, "message" => "Can't decrypt the token"], JSON_UNESCAPED_UNICODE);
	exit;
}

echo json_encode([
	"result_code" => 1,
	"data" => $parse['data']
]);