<?php include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<script type="text/javascript">
	<?php if($_SESSION[$_SESSION_ADMIN_PREFIX . 'idx']){?>
		location.href="./member/member_list.php?bmenu=1&smenu=1";
	<?php }else{?>
		location.href="./login/login.php";
	<?php }?>
</script>
