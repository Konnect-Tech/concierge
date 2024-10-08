<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));
$new_pwd = trim(sqlfilter($_REQUEST['new_pwd']));

$query = " UPDATE member_info SET ";
$query .= " `user_pwd` = '" . password_hash($new_pwd, PASSWORD_DEFAULT) . "' ";
$query .= " WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);
if($result){
	error_frame_go("密码变更已完成", "./mypage_main.php");
}else{
	error_frame("请重新确认一下新的密码");
}