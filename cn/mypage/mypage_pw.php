<?php

include("../_inc/head.php");

$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
if(!$member_idx){
	error_frame_go("请注意以下事项。", "../login/login.php");
	exit;
}

?>

<body>
    <div id="wrap">
        <header id="header">
            <div class="header__inner">
                <button type="button" class="btn_back"></button>
            </div>
            <div class="header__title">更换密码</div>
        </header>
        <main class="main">
            <div class="mypage__container mypage-pw">
                <form action="./mypage_pw_action.php" method="post" target="_fra_admin" name="frm">
					<input type="hidden" name="member_idx" value="<?=$member_idx?>">
                    <section class="join-form__wrap">
                        <div class="section__inner">
                            <div class="common-input__wrap">
                                <div class="common-box__input">
                                    <p class="join__sub-title">现在的密码</p>
                                    <input type="password" class="common-input" name="user_pwd" placeholder="请输入现在的密码" onkeyup="current_password_validate(this)" onkeypress="current_password_validate(this)" onkeydown="current_password_validate(this)">
                                    <!-- 유효성 검사 문구 addClass on 으로 노출 -->
                                    <span class="input-error__message">密码不一致，请再确认一下</span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">新的密码</p>
                                    <input type="password" class="common-input" name="new_pwd" placeholder="请输入新的密码" onkeyup="new_password_validate(this)" onkeydown="new_password_validate(this)" onkeypress="new_password_validate(this)">
                                    <!-- 유효성 검사 문구 addClass on 으로 노출 -->
                                    <span class="input-error__message">请将英文、数字、特殊文字组合在一起，输入8个字以上即可</span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">确认密码</p>
                                    <input type="password" class="common-input" name="new_pwd_chk" placeholder="请再一次输入" onkeydown="new_password_chk_validate(this)" onkeypress="new_password_chk_validate(this)" onkeyup="new_password_chk_validate(this)">
                                    <!-- 유효성 검사 문구 addClass on 으로 노출 -->
                                    <span class="input-error__message">密码不一致，请再确认一下</span>
                                </div>
                            </div>
                            <div class="button__wrap">
                                <button type="button" class="btn btn-radius on btn-modal" onclick="go_submit()">确认</button>
                            </div>
                        </div>
                    </section>

                    <!-- 모달 -->
                    <div class="modal-layer" data-modal="confirm">
                        <div class="modal-layer__window">
                            <div class="modal-body">
                                <p class="modal__text">密码变更已完成</p>
                            </div>
                            <div class="button__wrap">
                                <button type="submit" class="btn btn-radius btn-close">确认</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        <?php include("../_inc/menu.php"); ?>

    </div>

	<script defer>
        const error_slots = document.querySelectorAll('.input-error__message');
        const PASSWORD_REGEXP = /^(?=.*[a-zA-Z])((?=.*\d)(?=.*\W)).{8,16}$/;

        const FLAG_CURRENT_PASSWORD = 0b001;
        const FLAG_NEW_PASSWORD = 0b010;
        const FLAG_NEW_PASSWORD_CHK = 0b100;

        const ALL_FLAG_MASK = FLAG_CURRENT_PASSWORD | FLAG_NEW_PASSWORD | FLAG_NEW_PASSWORD_CHK;

        let current_flag = 0;

        const fnHasFlag = (flag) => (current_flag & flag) === flag;

        function current_password_validate(element){
            $.ajax({
				url: "/ajax/ajax_password_validate.php",
				dataType: "json",
				type: "POST",
				data:{
                    member_idx: "<?=$member_idx?>",
                    password: element.value.trim()
				},
				success: function (response){
                    if(response.code === 1){
                        if(error_slots[0].classList.contains("on")){
                            error_slots[0].classList.remove("on")
						}
                        current_flag |= FLAG_CURRENT_PASSWORD
					}else{
                        if(!error_slots[0].classList.contains("on")){
                            error_slots[0].classList.add("on")
						}
                        current_flag &= ~FLAG_CURRENT_PASSWORD
					}
				}
			})
		}

        function new_password_validate(element){
            if(!PASSWORD_REGEXP.test(element.value.trim())){
                if(!error_slots[1].classList.contains("on")){
                    error_slots[1].classList.add("on")
                }
                current_flag &= ~FLAG_NEW_PASSWORD;
            }else{
                if(error_slots[1].classList.contains("on")){
                    error_slots[1].classList.remove("on")
                }
                current_flag |= FLAG_NEW_PASSWORD;
            }
            // new_password_chk_validate(frm.new_pwd_chk)
        }

        function new_password_chk_validate(element){
            if(element.value.trim() !== frm.new_pwd.value.trim()){
                if(!error_slots[2].classList.contains("on")){
                    error_slots[2].classList.add("on")
                }
                current_flag &= ~FLAG_NEW_PASSWORD_CHK;
            }else{
                if(error_slots[2].classList.contains("on")){
                    error_slots[2].classList.remove("on")
                }
                current_flag |= FLAG_NEW_PASSWORD_CHK;
            }
        }

        function go_submit(){
            if(!fnHasFlag(FLAG_CURRENT_PASSWORD)){
                alert("目前密码不一致，请再确认一下")
				return
			}

            if(!fnHasFlag(FLAG_NEW_PASSWORD) || !fnHasFlag(FLAG_NEW_PASSWORD_CHK)){
                alert("请重新确认一下新的密码")
				return
			}

            frm.submit()
		}
	</script>

</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>