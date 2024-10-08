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
			<div class="header__title">비밀번호 찾기</div>
		</header>
		<main class="main">
			<div id="container" class="login_container">
				<div class="resend-email__inner">
					<h2>아래의 이메일로<br>인증메일이 발송 완료 되었습니다.</h2>
					<div class="result">
						<p><?=$email?></p>
					</div>
					<p class="txt3">발송된 이메일 확인 후 비밀번호를 재설정해<br> 주시기 바랍니다.이메일을 받지 못하신 경우<br> 고객센터로 문의해 주세요.</p>
					<a href="./login.php" class="btn-lg btn-w100p btn--main-color">로그인</a>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>
</body>
</html>