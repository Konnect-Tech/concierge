<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$email = trim(sqlfilter($_REQUEST['email']));
$password = trim(sqlfilter($_REQUEST['password']));
$password_chk = trim(sqlfilter($_REQUEST['password_chk']));

if(!$password || !$password_chk){
	error_frame("새 비밀번호를 입력해주세요.");
	exit;
}

if($password !== $password_chk){
	error_frame("비밀번호가 일치하지 않습니다.");
	exit;
}

$query = " UPDATE member_info SET ";
$query .= " `user_pwd` = '" . password_hash($password, PASSWORD_DEFAULT) . "' ";
$query .= " WHERE `user_id` = '$email' ";
$result = mysqli_query($gconnet, $query);
if($result){
	?>
	<script>
		parent.modalLayerOpen();
	</script>
<?php
}else{
	error_frame("비밀번호 변경 도중에 알 수 없는 오류가 발생했습니다.");
}