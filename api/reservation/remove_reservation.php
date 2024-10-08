<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_code = trim($_POST['member_code']);
$reserve_id = trim($_POST['reserve_id']);
if(!$member_code){
	echo json_encode(["result_code" => -1, "message" => "\"member_code\" parameter is required."], JSON_UNESCAPED_UNICODE);
	exit;
}

if(!$reserve_id){
	echo json_encode(["result_code" => -1, "message" => "\"reserve_id\" parameter is required."], JSON_UNESCAPED_UNICODE);
	exit;
}

$member_query = " SELECT idx FROM member_info WHERE `member_code` = '$member_code' ";
$member_result = mysqli_query($gconnet, $member_query);
if(!$member_result->num_rows){
	echo json_encode(["result_code" => -1, "message" => "Unable to find member data with matching member code"], JSON_UNESCAPED_UNICODE);
	exit;
}

$member_row = $member_result->fetch_array();
$member_idx = $member_row['idx'];

$query = " UPDATE member_info SET ";
$query .= " `used_voucher` = 'N' ";
$query .= " WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);

//$reserve_query = " SELECT idx FROM reservation_info WHERE `reserve_id` = '$reserve_id' AND `member_idx` = '$member_idx' ";
//$reserve_result = mysqli_query($gconnet, $reserve_query);
//if($reserve_result->num_rows){
//	$query = " UPDATE member_info SET ";
//	$query .= " `used_voucher` = 'N' ";
//	$query .= " WHERE `idx` = '$member_idx' ";
//	$result = mysqli_query($gconnet, $query);
//}

echo json_encode(["result_code" => 1], JSON_UNESCAPED_UNICODE);