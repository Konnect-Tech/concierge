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
			<div class="header__title">비밀번호 찾기</div>
		</header>
		<main class="main">
			<div id="container" class="login_container">
				<div class="find-info__inner">
					<p class="info-txt">
						입력하신 이메일로<br>인증 메일이 발송되었습니다.
					</p>
					<div class="result-pw">
						<span>아이디<em class="light">(이메일)</em></span>
						<p><?=$id?></p>
					</div>
					<div class="find-info__btn">
						<a href="./login.php" class="btn-lg btn-w100p btn--main-color">로그인</a>
					</div>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>
</body>
</html>