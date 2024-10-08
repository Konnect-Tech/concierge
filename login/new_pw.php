<?php

include("../_inc/head.php");

$code = trim(sqlfilter($_REQUEST['code']));
if(!$code){
	error_go("접근 불가능한 페이지입니다.", "/");
	exit;
}

$session_query = " SELECT * FROM link_session_list WHERE `code` = '$code' ";
$session_result = mysqli_query($gconnet, $session_query);
if(!$session_result->num_rows){
	error_go("접근 불가능한 페이지입니다.", "/");
	exit;
}

$session_row = $session_result->fetch_array();
$email = json_decode($session_row['extra'], true)['user_id'];
if($session_row['expire'] <= time()){
	no_error_go("./resend_pw_email.php?email=$email");
	exit;
}

?>
<body>
	<div id="wrap">
		<header id="header">
			<div class="header__title">새 비밀번호 설정</div>
		</header>
		<main class="main">
			<div id="container" class="login_container">
				<div class="find-info__inner">
					<form action="./new_pw_action.php" class="form_new-pw" target="_fra_admin" name="frm">
						<input type="hidden" name="email" value="<?=$email?>">
						<fieldset>
							<div class="login_input">
								<label for="name">새 비밀번호</label>
								<input type="password" name="password" placeholder="새 비밀번호를 입력해주세요." onkeydown="input_password(this)" onkeypress="input_password(this)" onkeyup="input_password(this)">
								<span class="input-error__message">영문, 숫자, 특수문자를 조합하여 8자 이상 입력해주세요.</span>
							</div>
							<div class="login_input">
								<label for="name">비밀번호 확인</label>
								<input type="password" name="password_chk" placeholder="한번 더 입력해주세요." onkeyup="input_password_chk(this)" onkeypress="input_password_chk(this)" onkeydown="input_password_chk(this)">
								<span class="input-error__message">비밀번호가 일치하지 않습니다. 다시 입력해주세요.</span>
							</div>
							<button type="button" class="btn-lg btn-w100p btn--main-color btn-modal" onclick="go_submit()">확인</button>
						</fieldset>
					</form>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>
	<!-- 비밀번호 변경 완료 모달 시작 -->
	<div class="modal-layer" data-modal="change-pw">
		<div class="modal-layer__window">
			<div class="modal-body">
				<div class="find-info__modal">
					<p>
						비밀번호 변경이 완료되었습니다.<br> 재로그인 해주세요.
					</p>
				</div>
			</div>
			<div class="button__wrap">
				<a href="./login.php" class="btn btn-radius btn-close">닫기</a>
			</div>
		</div>
	</div>
	<!-- 비밀번호 변경 완료 모달 끝 -->

	<script>
        function modalLayerOpen(){
            document.querySelector('.modal-layer').classList.add('on')
        }

        const error_slots = document.querySelectorAll('.input-error__message');
        const PASSWORD_REGEXP = /^(?=.*[a-zA-Z])((?=.*\d)(?=.*\W)).{8,16}$/;

        function input_password(element){
            let errno = error_slots[0];
            if(PASSWORD_REGEXP.test(element.value)){
                if(errno.classList.contains("on")){
                    errno.classList.remove("on")
				}
			}else{
                if(!errno.classList.contains("on")){
                    errno.classList.add("on")
				}
			}
            // input_password_chk(frm.password_chk)
		}

        function input_password_chk(element){
            let errno = error_slots[1];
            if(frm.password.value === element.value){
                if(errno.classList.contains("on")){
                    errno.classList.remove("on")
				}
			}else{
                if(!errno.classList.contains("on")){
                    errno.classList.add("on")
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