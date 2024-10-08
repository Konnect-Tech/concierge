<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$user_id = trim(sqlfilter($_REQUEST['user_id']));
$password = trim(sqlfilter($_REQUEST['password']));

$query = " SELECT * FROM member_info WHERE `user_id` = '$user_id' ";
$result = mysqli_query($gconnet, $query);
if($result->num_rows === 0){
	error_frame("这是还未注册的ID，请再确认一下");
	exit;
}

$row = $result->fetch_array();
if($row['is_del'] == 1){ //탈퇴된 계정
	error_frame("无法找到用该ID注册的会员信息。");
	exit;
}

if(!password_verify($password, $row['user_pwd'])){
	error_frame("密码不一致， 请再确认一下");
	exit;
}

$_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"] = $row['idx'];
$_SESSION[$_SESSION_DEFAULT_PREFIX . "name"] = $row['user_name'];
$_SESSION[$_SESSION_DEFAULT_PREFIX . "id"] = $row['user_id'];
$_SESSION[$_SESSION_DEFAULT_PREFIX . "code"] = $row['member_code'];

error_frame_go("您已成功登录。", "../");