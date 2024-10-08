<?php

include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));
$type = trim(sqlfilter($_REQUEST['type']));
$source = trim(sqlfilter($_REQUEST['source']));
$gubun = trim(sqlfilter($_REQUEST['gubun']));
$amount = str_replace(',', '', trim(sqlfilter($_REQUEST['amount'])));
$date = trim(sqlfilter($_REQUEST['date']));

if(!$source || !$gubun || !$amount){
	error_frame("모든 칸을 작성해주세요.");
	exit;
}

if(!is_numeric($amount)){
	error_frame("금액은 숫자로만 입력해주세요.");
	exit;
}

$query = " INSERT INTO currency_info SET ";
$query .= " `member_idx` = '$member_idx', ";
$query .= " `source` = '$source', ";
$query .= " `currency` = '원', ";
$query .= " `amount` = '$amount', ";
$query .= " `wdate` = NOW() ";
$result = mysqli_query($gconnet, $query);

$currency_idx = $gconnet->insert_id;

$query = " INSERT INTO buy_history_info SET ";
$query .= " `currency_idx` = '$currency_idx', ";
$query .= " `type` = '$type', ";
$query .= " `subject` = '$source', ";
if($date){
	$query .= " `date` = '$date', ";
}
$query .= " `gubun` = '$gubun' ";
$result = mysqli_query($gconnet, $query);

$member_query = " SELECT * FROM member_info WHERE `idx` = '$member_idx' ";
$member_result = mysqli_query($gconnet, $member_query);
$member_row = $member_result->fetch_array();
if($member_row['voucher_state'] == 0){
	$history_total_query = "
	SELECT 
		COALESCE(SUM(CASE WHEN c.currency = '원' AND h.gubun = '온라인' THEN c.amount ELSE 0 END), 0) AS W_total,
		COALESCE(SUM(CASE WHEN c.currency = 'M' THEN c.amount ELSE 0 END), 0) AS M_total
	FROM member_info AS m
	LEFT JOIN currency_info AS c ON m.idx = c.member_idx
	LEFT JOIN buy_history_info AS h ON c.idx = h.currency_idx
	WHERE m.idx = '$member_idx'
	GROUP BY m.idx
	";
	$history_total_result = mysqli_query($gconnet, $history_total_query);
	$history_total_row = $history_total_result->fetch_array();
	$total_currency = $history_total_row['W_total'] + $history_total_row['M_total'];
	if($total_currency >= 4000000){
		$query = " UPDATE member_info SET ";
		$query .= " `voucher_state` = '1', ";
		$query .= " `voucher_date` = NOW() ";
		$query .= " WHERE `idx` = '$member_idx' ";
		$result = mysqli_query($gconnet, $query);
	}
}

error_frame_reload("구매 내역을 정상적으로 추가했습니다.");