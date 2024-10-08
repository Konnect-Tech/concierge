<?php include("../_inc/head.php"); ?>
<body>
	<div id="wrap">
		<header id="header">
			<div class="header__inner">
				<button type="button" class="btn_back"></button>
				<a href="/" class="btn_home"></a>
			</div>
			<div class="header__title">로그인</div>
		</header>
		<main class="main">
			<div id="container" class="login_container">
				<div class="login__inner">
					<div class="login__logo">
						<div class="logo">
							<img src="../_img/common/logo-main.png" alt="로고">
						</div>
						<p>VIP를 위한 컨시어지 서비스</p>
					</div>
					<form action="./login_action.php" name="frm" method="post" target="_fra_admin" class="form_login">
						<fieldset>
							<div class="login_input">
								<label for="login_email">아이디<span class="light">(이메일)</span></label>
								<input type="text" id="login_email" name="user_id" placeholder="이메일을 입력해주세요." onkeydown="input_user_id(this)" onkeypress="input_user_id(this)" onkeyup="input_user_id(this)">
								<span class="input-error__message">이메일형식이 맞지 않습니다.</span>
							</div>
							<div class="login_input">
								<label for="login_pwd">비밀번호</label>
								<input type="password" id="login_pwd" name="password" placeholder="비밀번호를 입력해주세요." onkeypress="input_user_pwd(this)" onkeyup="input_user_pwd(this)" onkeydown="input_user_pwd(this)">
								 <span class="input-error__message">영문, 숫자, 특수문자를 조합하여 8자 이상 입력해주세요</span>
							</div>
							<!-- input 모두 입력된 상태: disabled제거 -->
							<button type="button" class="btn-lg btn-w100p btn_login" onclick="go_submit()">로그인</button>
						</fieldset>
					</form>
					<ul class="login_menu">
						<li><a href="./find_id.php">아이디 찾기</a></li>
						<li><a href="./find_pw.php">비밀번호 찾기</a></li>
						<li><a href="/join/join_1.php">회원가입</a></li>
					</ul>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>

	<script>
        const error_slots = document.querySelectorAll('.input-error__message');
        const EMAIL_REGEXP = /^[0-9a-zA-Z]([-_+\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_+\.]?[0-9a-zA-Z])*\.[a-zA-Z]/i;
        const PASSWORD_REGEXP = /^(?=.*[a-zA-Z])((?=.*\d)(?=.*\W)).{8,16}$/;

        frm.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                go_submit();
            }
        });

        function input_user_id(element){
            if(EMAIL_REGEXP.test(element.value)){
                if(error_slots[0].classList.contains("on")){
                    error_slots[0].classList.remove("on")
				}
			}else{
                if(!error_slots[0].classList.contains("on")){
                    error_slots[0].classList.add("on")
				}
			}
		}

        function input_user_pwd(element){
            if(PASSWORD_REGEXP.test(element.value)){
                if(error_slots[1].classList.contains("on")){
                    error_slots[1].classList.remove("on")
                }
            }else{
                if(!error_slots[1].classList.contains("on")){
                    error_slots[1].classList.add("on")
                }
            }
		}

        function go_submit(){
            if(document.querySelectorAll('.input-error__message.on').length !== 0){
                alert("모든 칸을 올바르게 입력해주세요.")
				return
			}

            frm.submit()
		}
	</script>
</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>