<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));
$new_pwd = trim(sqlfilter($_REQUEST['new_pwd']));

$query = " UPDATE member_info SET ";
$query .= " `user_pwd` = '" . password_hash($new_pwd, PASSWORD_DEFAULT) . "' ";
$query .= " WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);
if($result){
	?>
	<script>
		parent.modalLayerOpen();
	</script>
<?php
//	error_frame_go("비밀번호 변경이 완료되었습니다.", "./mypage_main.php");
}else{
	error_frame("비밀번호 변경 작업 도중에 알 수 없는 오류가 발생했습니다.");
}