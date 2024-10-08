<?php

include("../_inc/head.php");

$user_id = trim(sqlfilter($_REQUEST['id']));

?>
<body>
	<div id="wrap">
		<header id="header">
			<div class="header__inner">
				<button type="button" class="btn_back"></button>
			</div>
			<div class="header__title">查找账号</div>
		</header>
		<main class="main">
			<div id="container" class="login_container">
				<div class="find-info__inner">
					<p class="info-txt">
						与顾客的会员信息一致的<br> 用户名(电子邮件)如下
					</p>
					<div class="result">
						<p><?=$user_id?></p>
					</div>
					<div class="find-info__btn">
						<a href="./login.php" class="btn-lg btn-w100p btn--main-color">登录</a>
						<a href="./find_pw.php" class="btn-lg btn-w100p btn--sub-color">查找密码</a>
					</div>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>
</body>
</html>