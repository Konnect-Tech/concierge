<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));
if(!$member_idx){
	error_frame("请注意以下事项。");
	exit;
}

$query = " UPDATE member_info SET ";
$query .= " `profile_org` = NULL, ";
$query .= " `profile_chg` = 'default_profile.png' ";
$query .= " WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);
if($result){
	error_frame_reload("已更改为默认图像");
}else{
	error_frame("更改默认配置文件图像时发生未知错误。");
}