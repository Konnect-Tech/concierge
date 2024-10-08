<?php

include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));
$currency_type = trim(sqlfilter($_REQUEST['currency_type']));
$insert_type = trim(sqlfilter($_REQUEST['insert_type']));
$source = trim(sqlfilter($_REQUEST['source']));
$amount = str_replace(',', '', trim(sqlfilter($_REQUEST['amount'])));

if(!$source){
	error_frame("적립처명을 입력해주세요.");
	exit;
}

if(!is_numeric($amount)){
	error_frame("포인트는 숫자로만 입력해주세요.");
	exit;
}

if($insert_type === "+"){
	$insert_type = "";
}

if($insert_type === "-"){
	$point_query = "
	SELECT
		COALESCE(SUM(CASE WHEN c.currency = 'D' THEN c.amount ELSE 0 END), 0) AS D_total,
		COALESCE(SUM(CASE WHEN c.currency = 'M' THEN c.amount ELSE 0 END), 0) AS M_total
	FROM member_info AS m
	LEFT JOIN currency_info AS c ON m.idx = c.member_idx
	WHERE m.idx = '$member_idx'
	GROUP BY m.idx
	";
	$point_result = mysqli_query($gconnet, $point_query);
	$point_row = $point_result->fetch_array();
	if($point_row[strtoupper($currency_type) . "_total"] < $amount){
		error_frame("차감하려는 포인트가 보유한 포인트 보다 높습니다.");
		exit;
	}
}

$query = " INSERT INTO currency_info SET ";
$query .= " `member_idx` = '$member_idx', ";
$query .= " `source` = '$source', ";
$query .= " `currency` = '$currency_type', ";
$query .= " `amount` = '$insert_type$amount', ";
$query .= " `wdate` = NOW() ";
$result = mysqli_query($gconnet, $query);
if($result){
	error_frame_reload("포인트를 정상적으로 " . ($insert_type === "-" ? "차감" : "지급") . "했습니다.");
}else{
	error_frame("포인트 " . ($insert_type === "-" ? "차감" : "지급") . " 작업 도중에 알 수 없는 오류가 발생했습니다.");
}