<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$email = trim(sqlfilter($_REQUEST['email']));
$template_path = trim(sqlfilter($_REQUEST['template_path']));
$title = trim(sqlfilter($_REQUEST['title']));
if(!$title){
	$title = "커넥트 컨시어지 회원가입";
}

$valid_query = " SELECT idx FROM member_info WHERE `user_id` = '$email' ";
$valid_result = mysqli_query($gconnet, $valid_query);
if($valid_result->num_rows){
	echo json_encode(['result_code' => -1]);
	exit;
}

$code = mt_rand(1000, 9999);

$contents = file_get_contents($template_path);
$contents = str_replace(["{EMAIL}", "{NUM}"], [$email, $code], $contents);

lib_mail($title, $contents, $email, true);

echo json_encode(['code' => $code, 'result_code' => 1]);