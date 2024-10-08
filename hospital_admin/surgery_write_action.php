<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));
$reservation_uuid = trim(sqlfilter($_REQUEST['reservation_uuid']));
$promotion_idx = trim(sqlfilter($_REQUEST['promotion_idx']));
$reservation_idx = trim(sqlfilter($_REQUEST['reservation_idx']));
$hospital_id = trim(sqlfilter($_REQUEST['hospital_id']));
$hospital_code = trim(sqlfilter($_REQUEST['hospital_code']));
$surgery_addons = trim(sqlfilter($_REQUEST['surgery_addons']));
$point = str_replace(',', '', trim(sqlfilter($_REQUEST['point'])));
$paid = str_replace(',', '', trim(sqlfilter($_REQUEST['paid'])));
$memo = trim(sqlfilter($_REQUEST['memo']));
$have_point = trim(sqlfilter($_REQUEST['have_point']));

if(!$member_idx || !$reservation_idx || !$hospital_id || !$hospital_code){
	error_frame("회원 조회를 완료해주세요.");
	exit;
}

$admin_h_code = $_SESSION[$_SESSION_HOSPITAL_PREFIX . "code"];
if($admin_h_code !== $hospital_code){
	error_frame("타병원 예약 회원입니다");
	?>
	<script>
		parent.reset();
	</script>
<?php
	exit;
}

if($have_point < $point){
	error_frame("잔여 포인트가 부족합니다. 포인트를 다시 확인해주세요");
	exit;
}

$query = " INSERT INTO reservation_info SET ";
$query .= " `member_idx` = '$member_idx', ";
$query .= " `promotion_idx` = '$promotion_idx', ";
$query .= " `reserve_uuid` = '$reservation_uuid', ";
$query .= " `reserve_id` = '$reservation_idx', ";
$query .= " `hospital_id` = '$hospital_id', ";
$query .= " `hospital_code` = '$hospital_code', ";
$query .= " `surgery_addons` = '$surgery_addons', ";
$query .= " `point` = '$point', ";
$query .= " `paid` = '$paid', ";
$query .= " `memo` = '$memo', ";
$query .= " `wdate` = NOW() ";
$result = mysqli_query($gconnet, $query);
if($result){
	error_frame_go("시술내역 추가 작업이 정상적으로 완료했습니다.", "./calculate.php");
}else{
	error_frame("시술내역을 추가 작업 도중에 알 수 없는 오류가 발생했습니다. <br> 쿼리: " . sqlfilter($query) . " <br> 오류: " . sqlfilter($gconnet->error));
}