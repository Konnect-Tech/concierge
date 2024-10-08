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
			<div class="header__title">아이디 찾기</div>
		</header>
		<main class="main">
			<div id="container" class="login_container">
				<div class="find-info__inner">
					<p class="info-txt">
						고객님의 회원정보와 일치하는<br> 아이디(이메일)는 아래와 같습니다.
					</p>
					<div class="result">
						<p><?=$user_id?></p>
					</div>
					<div class="find-info__btn">
						<a href="./login.php" class="btn-lg btn-w100p btn--main-color">로그인하기</a>
						<a href="./find_pw.php" class="btn-lg btn-w100p btn--sub-color">비밀번호 찾기</a>
					</div>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>
</body>
</html>