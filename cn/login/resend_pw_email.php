<?php

include("../_inc/head.php");

$email = trim(sqlfilter($_REQUEST['email']));
if(!$email){
	error_go("접근 불가능한 페이지입니다.", "/");
	exit;
}

?>
<body>
	<form name="frm" method="post" action="./resend_pw_email_action.php" target="_fra_admin">
		<input type="hidden" name="email" value="<?=$email?>">
	</form>
	<div id="wrap">
		<header id="header">
			<div class="header__title">查找密码</div>
		</header>
		<main class="main">
			<div id="container" class="login_container">
				<div class="resend-email__inner">
					<h2>不是有效的链接</h2>
					<p class="txt1">请重新发送认证邮件，<br> 或重新进行查找密码</p>
					<p class="txt2">点击重新发送认证邮件，通过输入的电子邮件，会重新发送验证身份的邮件</p>
					<button type="button" class="btn-lg btn-w100p btn--main-color" onclick="frm.submit()">重新发送认证邮件</button>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>
</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>