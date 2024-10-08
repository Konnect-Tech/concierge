<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));

if(!isset($_FILES['file']) || $_FILES['file']['size'] <= 0){
	echo json_encode(['code' => 0]);
	exit;
}

$bbs_code = "profile";
$_P_DIR_FILE = $_P_DIR_FILE.$bbs_code."/";
$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs_code."/";

$file_org = $_FILES['file']['name'];
$file_chg = uploadFile($_FILES, 'file', $_FILES['file'], $_P_DIR_FILE);

$query = " UPDATE member_info SET ";
$query .= " `profile_org` = '$file_org', ";
$query .= " `profile_chg` = '$file_chg' ";
$query .= " WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);
echo json_encode(['code' => $result ? 1 : 0]);