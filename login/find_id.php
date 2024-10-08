<?php

include("../_inc/head.php");

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
						가입 시 입력하신 이름과<br> 휴대폰번호를 입력해주세요
					</p>
					<form action="./find_id_action.php" name="frm" method="post" target="_fra_admin" class="form_find-id">
						<fieldset>
							<div class="login_input">
								<label for="name">성명</label>
								<div class="name_input">
									<input type="text" name="user_last_name" placeholder="LAST NAME(성)" onkeypress="button_accessor()" onkeydown="button_accessor()" onkeyup="button_accessor()">
									<input type="text" name="user_first_name" placeholder="FIRST NAME(이름)" onkeypress="button_accessor()" onkeydown="button_accessor()" onkeyup="button_accessor()">
								</div>
							</div>
							<div class="login_input">
								<label for="name">휴대폰 번호</label>
								<div class="tel_input">
									<select class="common-select" name="phone_code" onchange="autoHyphen2(phone_num)">
										<option value="86" selected>중국(86)</option>
										<option value="82">한국(82)</option>
									</select>
									<input type="text" placeholder="010-1234-1234" oninput="autoHyphen2(this)" name="phone_num" maxlength="13" onkeypress="button_accessor()" onkeydown="button_accessor()" onkeyup="button_accessor()">
								</div>
							</div>
							<!-- 이름, 휴대폰번호 입력시 button에 disabled 제거 -->
							<button type="button" class="btn-lg btn-w100p btn_find-id btn-modal" disabled onclick="go_submit()">아이디 찾기</button>
						</fieldset>
					</form>
					<ul class="login_menu">
						<li><a href="./login.php">로그인</a></li>
						<li><a href="./find_pw.php">비밀번호 찾기</a></li>
						<li><a href="../join/join_1.php">회원가입</a></li>
					</ul>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>
	<!-- 아이디 검색결과 없음 모달 시작 -->
	<div class="modal-layer" data-modal="not-result">
		<div class="modal-layer__window">
			<div class="modal-body">
				<div class="find-info__modal">
					<p>
						입력하신 정보로<br> 아이디를 확인할 수 없습니다.<br> 다시 확인해주세요.
					</p>
				</div>
			</div>
			<div class="button__wrap">
				<a href="javascript:;" class="btn btn-radius btn-close">닫기</a>
			</div>
		</div>
	</div>
	<!-- 아이디 검색결과 없음 모달 끝 -->
	<script>
        function handleOnInput(e) {
            e.value = e.value.replace(/[^A-Za-z]/ig, '')
        }

        const autoHyphen2 = (target) => {
            target.value = target.value
                .replace(/[^0-9]/g, '')
                .replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3").replace(/(\-{1,2})$/g, "");
        }

		function button_accessor(){
            if(
                frm.user_last_name.value.trim() !== ''
				&& frm.user_first_name.value.trim() !== ''
				&& frm.phone_num.value.trim() !== ''
			){
                document.querySelector('.btn-modal').removeAttribute('disabled')
			}
		}

        function modalLayerOpen(){
            document.querySelector('.modal-layer').classList.add('on')
		}

        function go_submit(){
            if(document.querySelector('.btn-modal').hasAttribute("disabled")){
                return
			}

            frm.submit()
		}
	</script>
</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>