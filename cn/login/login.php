<?php include("../_inc/head.php"); ?>
<body>
	<div id="wrap">
		<header id="header">
			<div class="header__inner">
				<button type="button" class="btn_back"></button>
				<a href="/cn/index.php" class="btn_home"></a>
			</div>
			<div class="header__title">登录</div>
		</header>
		<main class="main">
			<div id="container" class="login_container">
				<div class="login__inner">
					<div class="login__logo">
						<div class="logo">
							<img src="../_img/common/logo-main.png" alt="logo">
						</div>
						<p>仅为VIP客户提供的服务</p>
					</div>
					<form action="./login_action.php" name="frm" method="post" target="_fra_admin" class="form_login">
						<fieldset>
							<div class="login_input">
								<label for="login_email">账号<span class="light">(邮箱号)</span></label>
								<input type="text" id="login_email" name="user_id" placeholder="请输入邮箱号" onkeydown="input_user_id(this)" onkeypress="input_user_id(this)" onkeyup="input_user_id(this)">
								<span class="input-error__message">电子邮件地址不正确</span>
							</div>
							<div class="login_input">
								<label for="login_pwd">密码</label>
								<input type="password" id="login_pwd" name="password" placeholder="请输入密码" onkeypress="input_user_pwd(this)" onkeyup="input_user_pwd(this)" onkeydown="input_user_pwd(this)">
								 <span class="input-error__message">请将英文、数字、特殊文字组合在一起，输入8个字以上即可</span>
							</div>
							<!-- input 모두 입력된 상태: disabled제거 -->
							<button type="button" class="btn-lg btn-w100p btn_login" onclick="go_submit()">登录</button>
						</fieldset>
					</form>
					<ul class="login_menu">
						<li><a href="./find_id.php">登录</a></li>
						<li><a href="./find_pw.php">查找账号</a></li>
						<li><a href="../join/join_1.php">注册会员</a></li>
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