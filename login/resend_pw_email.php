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
			<div class="header__title">비밀번호 찾기</div>
		</header>
		<main class="main">
			<div id="container" class="login_container">
				<div class="resend-email__inner">
					<h2>유효한 URL이 아닙니다.</h2>
					<p class="txt1">인증메일을 재발송하거나<br> 비밀번호 찾기를 다시 진행해 주시기 바랍니다.</p>
					<p class="txt2">인증메일 재발송 버튼을 클릭하시면 입력한<br> 이메일로 본인인증을 위한 메일이 재발송됩니다.</p>
					<button type="button" class="btn-lg btn-w100p btn--main-color" onclick="frm.submit()">인증메일 재발송</button>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>
</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>