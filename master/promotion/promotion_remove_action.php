<?php

include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드
include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더
include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인

$total_param = trim(sqlfilter($_REQUEST['total_param']));
$idxList = trim(sqlfilter($_REQUEST['idx']));

$idx_map = array_filter(explode(',', $idxList));

$shift = array_shift($idx_map);
$where = " idx = '$shift' ";
foreach($idx_map as $idx){
	$where .= " OR idx = '$idx' ";
}

$query = " DELETE FROM promotion_info WHERE $where ";
$result = mysqli_query($gconnet, $query);
if($result){
	error_frame_reload("선택하신 프로모션 데이터를 모두 삭제했습니다.");
}else{
	error_frame("프로모션 삭제 도중에 알 수 없는 오류가 발생했습니다.");
}