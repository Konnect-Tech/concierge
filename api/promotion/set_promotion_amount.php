<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$code = trim(sqlfilter($_POST['code']));
$amount = trim(sqlfilter($_POST['amount']));
if(!$code){
	echo json_encode(["result_code" => -1, "message" => "\"code\" parameter is required."], JSON_UNESCAPED_UNICODE);
	exit;
}

if(!$amount){
	echo json_encode(["result_code" => -1, "message" => "\"amount\" parameter is required."], JSON_UNESCAPED_UNICODE);
	exit;
}

$query = "
SELECT `idx`,`amount`
FROM promotion_info
WHERE `code` = '$code'
";
$result = mysqli_query($gconnet, $query);
if(!$result){
	echo json_encode(["result_code" => -1, "message" => $gconnet->error], JSON_UNESCAPED_UNICODE);
	exit;
}

$_row = $result->fetch_assoc();
$idx = $_row['idx'];
$result_amount = max(0, intval($_row['amount']) + intval($amount));

$query = " UPDATE promotion_info SET ";
$query .= " `amount` = '$result_amount' ";
$query .= " WHERE `idx` = '$idx' ";
$result = mysqli_query($gconnet, $query);
if($result){
	echo json_encode(["result_code" => 1], JSON_UNESCAPED_UNICODE);
}else{
	echo json_encode(["result_code" => -1, "message" => $gconnet->error], JSON_UNESCAPED_UNICODE);
}