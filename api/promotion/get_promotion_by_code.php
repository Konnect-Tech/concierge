<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$code = trim(sqlfilter($_REQUEST['code']));
if(!$code){
	echo json_encode(["result_code" => -1, "message" => "\"code\" parameter is required."], JSON_UNESCAPED_UNICODE);
	exit;
}

$query = "
SELECT *
FROM promotion_info
WHERE `code` = '$code'
";
$result = mysqli_query($gconnet, $query);
if(!$result){
	echo json_encode(["result_code" => -1, "message" => $gconnet->error], JSON_UNESCAPED_UNICODE);
	exit;
}

echo json_encode(["result_code" => 1, "data" => $result->fetch_assoc()], JSON_UNESCAPED_UNICODE);