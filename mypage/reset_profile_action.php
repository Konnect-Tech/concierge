<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));
if(!$member_idx){
	error_frame("로그인 후 이용 가능한 서비스입니다.");
	exit;
}

$query = " UPDATE member_info SET ";
$query .= " `profile_org` = NULL, ";
$query .= " `profile_chg` = 'default_profile.png' ";
$query .= " WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);
if($result){
	error_frame_reload("정상적으로 기본 프로필 이미지로 변경했습니다.");
}else{
	error_frame("기본 프로필 이미지로 변경하던 도중에 알 수 없는 오류가 발생했습니다.");
}