<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$id = trim(sqlfilter($_REQUEST['id']));
if(!$id){
	echo json_encode(["result_code" => -1, "message" => "\"id\" parameter is required."], JSON_UNESCAPED_UNICODE);
	exit;
}

$query = "
SELECT *
FROM member_info
WHERE `user_id` = '$id'
";
$result = mysqli_query($gconnet, $query);
if(!$result){
	echo json_encode(["result_code" => -1, "message" => $gconnet->error], JSON_UNESCAPED_UNICODE);
	exit;
}

echo json_encode(["result_code" => 1, "data" => $result->fetch_assoc()], JSON_UNESCAPED_UNICODE);