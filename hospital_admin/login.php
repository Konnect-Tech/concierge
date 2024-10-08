<?php include("../_inc/admin_head.php"); ?>
<body>
	<div id="ad-wrap">
		<div class="ad-container">
			<header class="ad-header">
				<div class="ad-header__inner">
					<div class="logo_area">
						<div class="logo">
							<h1>Konnect Concierge</h1>
						</div>
					</div>
				</div>
			</header>
			<main class="ad-main">
				<div class="login__inner">
					<h1>커넥트 컨시어지 플랫폼<br> 제휴병원 정산 관리 시스템</h1>
					<form action="./login_action.php" method="post" name="frm" target="_fra_admin" class="form_login">
						<fieldset>
							<div class="input_login">
								<input type="text" name="code" placeholder="병원고유코드를 입력하세요.">
								<span class="err-txt" style="display: none">없는 코드입니다. 확인 후  다시 입력해주세요</span>
							</div>
							<button class="btn_login">로그인</button>
						</fieldset>
					</form>
				</div>
			</main>
		</div>
	</div>

	<script>
        const error_preset = document.querySelector('.err-txt');

        function appear_preset(){
            error_preset.style.display = 'block';
		}
	</script>
</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>