<?php include("../_inc/head.php"); ?>
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
						请输入注册时的账号（邮箱号）<br> 和姓名，以及手机号
					</p>
					<form action="./find_pw_action.php" name="frm" method="post" target="_fra_admin" class="form_find-pw">
						<fieldset>
							<div class="login_input">
								<label for="name">账号<span class="light">(邮箱号)</span></label>
								<input type="text" name="user_id" placeholder="请输入邮箱号">
							</div>
							<div class="login_input">
								<label for="name">姓名</label>
								<div class="name_input">
									<input type="text" name="user_last_name" placeholder="姓" oninput="handleOnInput(this)">
									<input type="text" name="user_first_name" placeholder="名字" oninput="handleOnInput(this)">
								</div>
							</div>
							<div class="login_input">
								<label for="name">手机号</label>
								<div class="tel_input">
									<select class="common-select" name="phone_code">
										<option value="86" selected>中国(86)</option>
										<option value="82">韩国(82)</option>
									</select>
									<input type="text" placeholder="010-1234-1234" name="phone_num" oninput="autoHyphen2(this)" maxlength="13">
								</div>
							</div>
							<!-- 이름, 휴대폰번호 입력시 button에 disabled 제거 -->
							<button type="button" class="btn-lg btn-w100p btn_find-id btn-modal" disabled onclick="go_submit()">查找密码</button>
						</fieldset>
					</form>
					<ul class="login_menu">
						<li><a href="./login.php">登录 </a></li>
						<li><a href="./find_id.php">查找账号</a></li>
						<li><a href="../join/join_1.php">注册会员</a></li>
					</ul>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>
	<!-- 비밀번호 검색결과 없음 모달 시작 -->
	<div class="modal-layer" data-modal="not-result">
		<div class="modal-layer__window">
			<div class="modal-body">
				<div class="find-info__modal">
					<p>
						无法确认您输入的信息。<br> 请再确认一下
					</p>
				</div>
			</div>
			<div class="button__wrap">
				<a href="javascript:re();" class="btn btn-radius btn-close">关闭</a>
			</div>
		</div>
	</div>
	<!-- 비밀번호 검색결과 없음 모달 끝 -->
	<script>
        const autoHyphen2 = (target) => {
            target.value = target.value
                .replace(/[^0-9]/g, '')
                .replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3").replace(/(\-{1,2})$/g, "");
        }

        function modalLayerOpen(){
            document.querySelector('.modal-layer').classList.add('on')
        }

        function re(){
            f = false

            document.querySelector(".btn_find-id").classList.remove("btn-load");
            document.querySelector(".btn_find-id").innerText = "查找密码";
        }

        function scan(){
            const inputs = document.querySelectorAll('input');
            const fn = function (){
                let v = true;
                inputs.forEach((e) => {
                    if(e.value.trim().length === 0){
                        v = false;
                    }
                })
                if(v){
                    document.querySelectorAll('button')[1].removeAttribute('disabled')
                }else{
                    document.querySelectorAll('button')[1].setAttribute('disabled', '')
                }
            };
            inputs.forEach((e) => {
                e.addEventListener('keypress', fn)
                e.addEventListener('keyup', fn)
                e.addEventListener('keydown', fn)
            })
        }

        scan();

        let f = false;

        function go_submit(){
            if(f){
                return;
            }
            if(frm.user_id.value.trim() === ''){
                alert("아이디를 입력해주세요.")
                frm.user_id.focus()
                return
            }

            if(frm.user_last_name.value.trim() === ''){
                alert("영문명 성을 입력해주세요.")
                frm.user_last_name.focus()
                return
            }

            if(frm.user_first_name.value.trim() === ''){
                alert("영문명 이름을 입력해주세요.")
                frm.user_first_name.focus()
                return
            }

            if(frm.phone_num.value.trim() === ''){
                alert("휴대폰 번호를 입력해주세요.")
                frm.phone_num.focus()
                return
            }

            frm.submit()
            // 2023-10-17 퍼블 로딩이미지 추가
            document.querySelector(".btn_find-id").classList.add("btn-load");
            document.querySelector(".btn_find-id").innerText = "";
            f = true
        }
	</script>
</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>