<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));
$password = trim(sqlfilter($_REQUEST['password']));

$query = " SELECT user_pwd FROM member_info WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);
if($result->num_rows === 0){
	echo json_encode(['code' => 0]);
	exit;
}

$row = $result->fetch_array();
echo json_encode(['code' => password_verify($password, $row['user_pwd']) ? 1 : 0]);