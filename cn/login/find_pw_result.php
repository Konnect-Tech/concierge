<?php

include("../_inc/head.php");

$id = trim(sqlfilter($_REQUEST['id']));

?>
<body>
	<div id="wrap">
		<header id="header">
			<div class="header__inner">
				<button type="button" class="btn_back"></button>
			</div>
			<div class="header__title">查找密码</div>
		</header>
		<main class="main">
			<div id="container" class="login_container">
				<div class="find-info__inner">
					<p class="info-txt">
						验证邮件已发送到您输入的邮箱号
					</p>
					<div class="result-pw">
						<span>账号<em class="light">(邮箱号)</em></span>
						<p><?=$id?></p>
					</div>
					<div class="find-info__btn">
						<a href="./login.php" class="btn-lg btn-w100p btn--main-color">登录</a>
					</div>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>
</body>
</html>