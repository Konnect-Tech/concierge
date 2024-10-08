<?php
	$bmenu = trim(sqlfilter($_REQUEST['bmenu']));
	$smenu = trim(sqlfilter($_REQUEST['smenu']));
?>
<!-- 관리자 계정만 있으면 통과시킨다 -->
<?php
if(!$_SESSION[$_SESSION_ADMIN_PREFIX . 'idx']){
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	alert('먼저 관리자로 로그인해 주십시오.');
	
//-->
</SCRIPT>
	<?php
exit;
}
?>