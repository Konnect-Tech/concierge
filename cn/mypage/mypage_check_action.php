<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));
$user_id = trim(sqlfilter($_REQUEST['user_id']));
$user_pwd = trim(sqlfilter($_REQUEST['user_pwd']));

$query = " SELECT `user_pwd` FROM member_info WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);
if($result->num_rows === 0){
	error_frame("未找到会员数据。");
	exit;
}

$row = $result->fetch_array();
if(!password_verify($user_pwd, $row['user_pwd'])){
	error_frame("密码不一致，请再确认一下");
	exit;
}

frame_go("./mypage_edit.php");