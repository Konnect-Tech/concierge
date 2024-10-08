<?php

include("../_inc/head.php");

$email = trim(sqlfilter($_REQUEST['email']));
if(!$email){
	error_go("접근 불가능한 페이지입니다.", "/");
	exit;
}

?>
<body>
	<div id="wrap">
		<header id="header">
			<div class="header__title">查找密码</div>
		</header>
		<main class="main">
			<div id="container" class="login_container">
				<div class="resend-email__inner">
					<h2>已把认证邮件<br>重新发送到以下邮件</h2>
					<div class="result">
						<p><?=$email?></p>
					</div>
					<p class="txt3">请确认发送的电子邮件后重新设置密码。<br>如果您没有收到电子邮件，请咨询客服中心</p>
					<a href="./login.php" class="btn-lg btn-w100p btn--main-color">登录</a>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>
</body>
</html>