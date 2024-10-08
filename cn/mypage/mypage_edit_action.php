<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));
$user_last_name = trim(sqlfilter($_REQUEST['user_last_name']));
$user_first_name = trim(sqlfilter($_REQUEST['user_first_name']));
$birthday = trim(sqlfilter($_REQUEST['birthday']));
$gender = trim(sqlfilter($_REQUEST['gender']));
$phone_code = trim(sqlfilter($_REQUEST['phone_code']));
$phone_num = trim(sqlfilter($_REQUEST['phone_num']));

$query = " UPDATE member_info SET ";
$query .= " `user_last_name` = '$user_last_name', ";
$query .= " `user_first_name` = '$user_first_name', ";
$query .= " `birthday` = '$birthday', ";
$query .= " `gender` = '$gender', ";
$query .= " `phone_code` = '$phone_code', ";
$query .= " `phone_num` = '$phone_num' ";
$query .= " WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);
if($result){
	$_SESSION[$_SESSION_DEFAULT_PREFIX . "name"] = $user_last_name . " " . $user_first_name;
	error_frame_go("信息修改已完成", "./mypage_main.php");
}else{
	error_frame("编辑个人信息时发生未知错误。");
}