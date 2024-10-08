<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$user_id = trim(sqlfilter($_REQUEST['user_id']));
$user_last_name = strtoupper(trim(sqlfilter($_REQUEST['user_last_name'])));
$user_first_name = strtoupper(trim(sqlfilter($_REQUEST['user_first_name'])));
$phone_code = trim(sqlfilter($_REQUEST['phone_code']));
$phone_num = trim(sqlfilter($_REQUEST['phone_num']));
$phone_num = cell_format($phone_num);

$query = " SELECT `idx`,`user_name`,`user_id` FROM member_info WHERE `user_id` = '$user_id' AND `user_last_name` = '$user_last_name' AND `user_first_name` = '$user_first_name' AND `phone_code` = '$phone_code' AND `phone_num` = '$phone_num' ";
$result = mysqli_query($gconnet, $query);
if($result->num_rows === 0){
//	error_frame(sqlfilter($query));
	?>
	<script>
        parent.modalLayerOpen()
	</script>
	<?php
	exit;
}

//frame_go("./find_pw_result.php?id=$user_id");

$row = $result->fetch_array();

$contents = file_get_contents("./find_pw_email.html");
if($contents === false){
	error_frame("메일 발송 도중에 알 수 없는 오류가 발생했습니다.");
	exit;
}

$session_code = strtoupper(randomChar(random_int(3, 5))) . random_int(1, 10) . strtoupper(randomChar(random_int(1, 3)));

$session_query = " INSERT INTO link_session_list SET ";
$session_query .= " `code` = '$session_code', ";
$session_query .= " `extra` = '" . json_encode(["user_id" => $row['user_id']]) . "', ";
$session_query .= " `expire` = '" . strtotime("+30 minutes", time()) . "' ";
$session_result = mysqli_query($gconnet, $session_query);
if($session_result){
	$contents = str_replace(["{NAME}", "{CODE}"], [$row['user_name'], $session_code], $contents);
	if(lib_mail("[KONNECT CS] '{$row['user_name']}', 为更改密码的链接已发送。", $contents, $row['user_id'], true)){
		frame_go("./find_pw_result.php?id=$user_id");
	}else{
		error_frame("메일 발송 도중에 알 수 없는 오류가 발생했습니다.");
	}
}else{
	error_frame("메일 발송 도중에 알 수 없는 오류가 발생했습니다.");
}