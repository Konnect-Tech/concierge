<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$email = trim(sqlfilter($_REQUEST['email']));

$query = " SELECT user_name FROM member_info WHERE `user_id` = '$email' ";
$result = mysqli_query($gconnet, $query);
$row = $result->fetch_array();

$contents = file_get_contents("./find_pw_email.html");
if($contents === false){
	error_frame("메일 발송 도중에 알 수 없는 오류가 발생했습니다.");
	exit;
}

$session_code = strtoupper(randomChar(random_int(3, 5))) . random_int(1, 10) . strtoupper(randomChar(random_int(1, 3)));

$session_query = " INSERT INTO link_session_list SET ";
$session_query .= " `code` = '$session_code', ";
$session_query .= " `extra` = '" . json_encode(["user_id" => $email]) . "', ";
$session_query .= " `expire` = '" . strtotime("+30 minutes", time()) . "' ";
$session_result = mysqli_query($gconnet, $session_query);
if($session_result){
	$contents = str_replace(["{NAME}", "{CODE}"], [$row['user_name'], $session_code], $contents);
	if(lib_mail("[커넥트컨시어지] ‘{$row['user_name']}' 님, 비밀번호 변경을 위한 링크가 발송되었습니다.", $contents, $email, true)){
		frame_go("./resend_complete.php?email=$email");
	}else{
		error_frame("메일 발송 도중에 알 수 없는 오류가 발생했습니다.");
	}
}else{
	error_frame("메일 발송 도중에 알 수 없는 오류가 발생했습니다.");
}