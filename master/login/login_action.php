<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<?php
$pm_id = trim(sqlfilter($_REQUEST['lms_id']));
$pm_pwd = trim(sqlfilter($_REQUEST['lms_pass']));
$reurl_go = trim(sqlfilter($_REQUEST['reurl_go']));
//exit;

$sql = "select * from member_info where 1 and user_id='" . $pm_id . "' and member_type='AD'";
$result = mysqli_query($gconnet, $sql);

if(mysqli_num_rows($result) > 0){

	$row = mysqli_fetch_array($result);
	if(!password_verify($pm_pwd, $row['user_pwd'])){
		error_frame("비밀번호가 일치하지 않습니다. 다시 확인하시고 로그인 해주세요! ");
	}

	$_SESSION[$_SESSION_ADMIN_PREFIX . 'id'] = $pm_id;
	$_SESSION[$_SESSION_ADMIN_PREFIX . 'type'] = $row['member_type'];
	$_SESSION[$_SESSION_ADMIN_PREFIX . 'idx'] = $row['idx'];
	$_SESSION[$_SESSION_ADMIN_PREFIX . 'name'] = $row['user_name'];
	$_SESSION[$_SESSION_ADMIN_PREFIX . 'password'] = $pm_pwd;

	if(!$reurl_go){
		$reurl_go = "../member/member_list.php?bmenu=1&smenu=1";
	}

	?>

	<script type="text/javascript">
        parent.location.href = "<?=$reurl_go?>";
	</script>

	<?php

}else{
	error_frame("일치하는 관리자 계정이 없습니다. 다시 확인하시고 로그인 해주세요! ");
	exit;
}
?>

