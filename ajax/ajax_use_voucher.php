<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));
if(!$member_idx){
	echo json_encode(['result_code' => -1]);
	exit;
}

$reservations = get_reservations($_SESSION[$_SESSION_DEFAULT_PREFIX . "id"]);
if(count($reservations) === 0){
	echo json_encode(['result_code' => -1]);
	exit;
}

$reserve = $reservations[0];
if(treated_reservation($reserve["id"])){
//	$promotion_code = $reserve['requestDetail']['promotionCode'];
//
//	$pressedQueries = [];
//
//	$promotion_amount_query = " SELECT amount FROM promotion_info WHERE `code` = '$promotion_code' ";
//	$promotion_amount_result = mysqli_query($gconnet, $promotion_amount_query);
//	$promotion_amount = intval($promotion_amount_result->fetch_array()['amount']);
//
//	$promotion_query = " UPDATE promotion_info SET ";
//	$promotion_query .= " `amount` = '" . ($promotion_amount - 1) . "' ";
//	$promotion_query .= " WHERE `code` = '$promotion_code' ";
//	$pressedQueries[] = $promotion_query;


	$query = " UPDATE member_info SET ";
	$query .= " `used_voucher` = '1' ";
	$query .= " WHERE `idx` = '$member_idx' ";
	$result = mysqli_query($gconnet, $query);
//	$pressedQueries[] = $query;
//
//	$result = mysqli_multi_query($gconnet, implode('; ', $pressedQueries));
	if($result){
		echo json_encode(['result_code' => 1]);
	}else{
		echo json_encode(['result_code' => -1]);
	}
}else{
	echo json_encode(['result_code' => -1]);
}
