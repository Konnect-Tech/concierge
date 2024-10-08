<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$id = trim(sqlfilter($_POST['id']));

$member_query = " SELECT * FROM member_info WHERE `user_id` = '$id' ";
$member_result = mysqli_query($gconnet, $member_query);
if(!$member_result->num_rows){
	echo json_encode(["result_code" => -1, "message" => "Unable to find member data with matching user_id"], JSON_UNESCAPED_UNICODE);
	exit;
}

$member_row = $member_result->fetch_array();
if($member_row["voucher_state"] == 0){
	echo json_encode(["result_code" => -1, "message" => "바우처가 지급되지 않은 회원입니다."], JSON_UNESCAPED_UNICODE);
	exit;
}

if($member_row["used_voucher"] == 1){
	echo json_encode(["result_code" => -1, "message" => "이미 바우처를 사용했습니다."], JSON_UNESCAPED_UNICODE);
	exit;
}

$query = " UPDATE member_info SET ";
$query .= " `used_voucher` = '1' ";
$query .= " WHERE `idx` = '" . $member_row['idx'] . "' ";
$result = mysqli_query($gconnet, $query);

echo json_encode(["result_code" => 1, "message" => "바우처 상태를 사용으로 변경했습니다."], JSON_UNESCAPED_UNICODE);