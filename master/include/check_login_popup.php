<?php
	$bmenu = trim(sqlfilter($_REQUEST['bmenu']));
	$smenu = trim(sqlfilter($_REQUEST['smenu']));
?>
<!-- 관리자 계정만 있으면 통과시킨다 -->
<?php
if(!$_SESSION['admin_session_idx']){
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	alert('먼저 관리자로 로그인해 주십시오.');
	self.close();
//-->
</SCRIPT>
	<?php
exit;
}
?>