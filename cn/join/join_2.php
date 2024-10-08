<?php

include("../_inc/head.php");

$email = trim(sqlfilter($_REQUEST['email']));
if(!$email){
	error_frame_go("该页面无法单独访问。", "./join_1.php");
	exit;
}

//$board_width = 800;
//$board_height = 800;

?>

<body>
    <div id="wrap">
        <header id="header">
            <div class="header__inner">
                <button type="button" class="btn_back"></button>
            </div>
            <div class="header__title">注册会员</div>
        </header>
        <main class="main">
            <div class="join__container">
                <form action="./join_write_action.php" method="post" name="frm" target="_fra_admin">
                    <div class="join-input__top step-2">
                        <h2 class="join__title">本人认证&同意条款</h2>
                        <p class="join__step"><span>1</span><span class="on">2</span></p>
                    </div>
                    <section class="join-info info-login">
                        <h3 class="join-info__title">登录信息</h3>
                        <div class="section__inner">
                            <div class="common-input__wrap">
                                <div class="common-box__input">
                                    <p class="join__sub-title">账号<span>(邮箱号)</span></p>
                                    <input type="email" class="common-input" name="email" value="<?=$email?>" readonly placeholder="请输入邮箱号">
                                    <!-- 유효성 검사 문구 addClass on 으로 노출 -->
                                    <span class="input-error__message">邮箱号形式不正确</span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">密码</p>
                                    <input type="password" class="common-input" name="password" placeholder="请输入密码" onkeydown="input_password(this)" onkeyup="input_password(this)" onkeypress="input_password(this)">
                                    <!-- 유효성 검사 문구 addClass on 으로 노출 -->
                                    <span class="input-error__message">密码请将英文、数字、特殊文字组合在一起，输入8个字以上即可</span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">确认密码</p>
                                    <input type="password" class="common-input" name="password_chk" placeholder="请再一次输入" onkeyup="input_password_chk(this)" onkeypress="input_password_chk(this)" onkeydown="input_password_chk(this)">
                                    <!-- 유효성 검사 문구 addClass on 으로 노출 -->
                                    <span class="input-error__message">密码不一致，请再确认一下</span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="join-info info-basic">
                        <h3 class="join-info__title">个人信息</h3>
                        <div class="section__inner">
                            <div class="common-input__wrap">
                                <div class="common-box__input">
                                    <p class="join__sub-title">姓名</p>
                                    <div class="input__inner name_input">
                                        <input type="text" class="common-input" name="user_last_name" placeholder="姓" style="text-transform: none;">
                                        <input type="text" class="common-input" name="user_first_name" placeholder="名字" style="text-transform: none;">
                                    </div>
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">生日年月日</p>
                                    <input type="text" class="common-input common-date-2" name="birthday" placeholder="生日年月日(YYYY-MM-DD)">
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">性别</p>
                                    <div class="input__inner">
                                        <div class="common-box__input type-button">
                                            <label>
                                                <input type="radio" name="gender" value="1" class="common-radio" checked>
                                                女
                                            </label>
                                        </div>
                                        <div class="common-box__input type-button">
                                            <label>
                                                <input type="radio" name="gender" value="0" class="common-radio">
                                                男
                                            </label>
                                        </div>
                                    </div> 
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">手机号码</p>
                                    <div class="input__inner">
                                        <select name="phone_code" class="common-select">
                                            <option value="86">中国(86)</option>
                                            <option value="82">韩国(82)</option>
                                        </select>
                                        <input type="tel" class="common-input" name="phone_num" placeholder="010-1234-1234" oninput="autoHyphen2(this)" maxlength="13">
                                    </div> 
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">WeChat ID</p>
                                    <input type="text" class="common-input" name="wechat_id" placeholder="请输入账号">
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">新罗免税店ID</p>
                                    <input type="text" class="common-input" name="shilla_id" placeholder="请输入账号">
                                    <span class="input-error__message"></span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="join-info info-passport">
                        <h3 class="join-info__title">护照信息</h3>
                        <div class="section__inner">
                            <div class="common-input__wrap">
                                <ul class="info-passport__list">
                                    <li><span class="dot">&middot;</span>如果出境护照上与护照号码不一致时，无法提供优惠，请准确输入</li>
                                    <li><span class="dot">&middot;</span>护照号码在确认优惠支付时使用，请准确输入</li>
                                    <li><span class="dot">&middot;</span>请准确区分英文"O"和数字"0"后输入</li>
                                </ul>
                                <div class="common-box__input">
                                    <p class="join__sub-title">护照英文名</p>
                                    <div class="input__inner name_input">
                                        <input type="text" class="common-input" name="passport_last_name" placeholder="姓" oninput="handleOnInput(this)">
                                        <input type="text" class="common-input" name="passport_first_name" placeholder="名字" oninput="handleOnInput(this)">
                                    </div>
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">护照号码</p>
                                    <div class="input__inner">
                                        <input type="text" class="common-input" name="passport_num" onkeydown="passport_chk = false;" onkeypress="passport_chk = false;" onkeyup="passport_chk = false;" placeholder="护照号码" data-modal="confirm_2">
                                        <button type="button" class="btn btn-radius btn-s" onclick="passport_num_validate()">重复确认</button>
                                    </div>
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">护照期限</p>
                                    <input type="text" class="common-input common-date" name="passport_expire_date" placeholder="YYYY-MM-DD" data-modal="confirm_1">
                                    <span class="input-error__message"></span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="info-personal">
                        <div class="section__inner">
                            <div class="common-input__wrap">
                                <div class="common-box__input">
                                    <p class="join__sub-title mb0">个人信息有效期</p>
                                    <p class="info-personal__text">个人信息有效期过后，将会分离储存/管理或销毁个人信息</p>
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <div class="input__inner">
                                        <div class="common-box__input radio">
                                            <label>
                                                <input type="radio" name="data_type" value="0" class="common-radio" checked>
                                                直到注销会员为止
                                            </label>
                                        </div>
                                        <div class="common-box__input radio">
                                            <label>
                                                <input type="radio" name="data_type" value="1" class="common-radio">
                                                1年
                                            </label>
                                        </div>
                                    </div> 
                                    <span class="input-error__message"></span>
                                </div>
                            </div>
                            <p class="join-info__text">点击注册按钮，完成会员注册后将会自动登录</p>
                            <div class="button__wrap">
                                <a href="javascript:history.back()" class="btn btn-radius btn-prev">上一步</a>
                                <button type="button" class="btn btn-radius btn-next" onclick="go_submit()">注册会员</button>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </main>

        <!-- <?php //include("../_inc/menu.php"); ?> -->

    </div>

    <!-- 모달 -->
    <div class="modal-layer" data-modal="confirm_1">
        <div class="modal-layer__window">
            <div class="modal-body">
                <p class="modal__text">这是可以使用的号码</p>
            </div>
            <div class="button__wrap">
                <button type="button" class="btn btn-radius btn-focus">确认</button>
            </div>
        </div>
    </div>

    <div class="modal-layer" data-modal="confirm_2">
        <div class="modal-layer__window">
            <div class="modal-body">
                <p class="modal__text">这是已经使用中的护照号码，<br>请再确认一下</p>
            </div>
            <div class="button__wrap">
                <button type="button" class="btn btn-radius btn-focus">确认</button>
            </div>
        </div>
    </div>

    <script>
        function handleOnInput(e) {
            e.value = e.value.replace(/[^A-Za-z]/ig, '')
        }

        const autoHyphen2 = (target) => {
            target.value = target.value
                .replace(/[^0-9]/g, '')
                .replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3").replace(/(\-{1,2})$/g, "");
        }

        $(".modal-layer .btn-focus").on("click",function(){
            const modalLayer = $(this).closest(".modal-layer");
            const modalData = modalLayer.attr("data-modal");

            modalLayer.removeClass("on");
            $("body").removeClass("fixed");
            $(`.common-input[data-modal=${modalData}]`).focus();
        });

        const error_slots = document.querySelectorAll('.input-error__message');
        const modal_slots = document.querySelectorAll('.modal-layer');
        const PASSWORD_REGEXP = /^(?=.*[a-zA-Z])((?=.*\d)(?=.*\W)).{8,16}$/;

        let passport_chk = false;

        function input_password(element){
            if(PASSWORD_REGEXP.test(element.value)){
                if(error_slots[1].classList.contains("on")){
                    error_slots[1].classList.remove("on")
                }
            }else{
                if(!error_slots[1].classList.contains("on")){
                    error_slots[1].classList.add("on")
                }
            }
            // input_password_chk(frm.password_chk)
        }

        function input_password_chk(element){
            if(element.value !== frm.password.value){
                if(!error_slots[2].classList.contains("on")){
                    error_slots[2].classList.add("on")
                }
            }else{
                if(error_slots[2].classList.contains("on")){
                    error_slots[2].classList.remove("on")
                }
            }
        }

        function passport_num_validate(){

            let passport_num = frm.passport_num.value.trim()
            if(passport_num === ''){
                alert("请输入您的护照号码。")
                frm.passport_num.focus()
                return
            }

            $.ajax({
                url: "/ajax/ajax_passport_num_validate.php",
                type: "POST",
                dataType: "json",
                data: {
                    passport_num: passport_num
                },
                success: function (response){
                    console.log(response)
                    if(response.code === 0){
                        passport_chk = true;
                    }else {
                        passport_chk = false
                    }
                    modal_slots[response.code].classList.add('on')
                }
            })
        }

		function go_submit(){
            if(!PASSWORD_REGEXP.test(frm.password.value)){
                alert("请输入至少 8 个字符的密码，并使用字母、数字和特殊字符的组合。")
				frm.password.focus()
				return
			}

            if(frm.password_chk.value !== frm.password.value){
                alert("密码不一致，请再确认一下")
				frm.password_chk.focus()
				return
			}

            if(frm.user_last_name.value.trim() === ''){
                alert("请输入姓名")
				frm.user_last_name.focus()
				return
			}

            if(frm.user_first_name.value.trim() === ''){
                alert("请输入名字")
				frm.user_first_name.focus()
				return
			}

            if(frm.birthday.value.trim() === ''){
                alert("请输入生日")
				frm.birthday.focus()
				return
			}

            if(frm.phone_num.value.trim() === ''){
                alert("请输入手机号")
				frm.phone_num.focus()
				return
			}

            if(frm.wechat_id.value.trim() === ''){
                alert("请输入微信ID")
				frm.wechat_id.focus()
				return
			}

            if(frm.shilla_id.value.trim() === ''){
                alert("请输入新罗免税店的ID")
				frm.shilla_id.focus()
				return
			}

            if(frm.passport_last_name.value.trim() === ''){
                alert("请输入护照上登记的\"姓\"")
				frm.passport_last_name.focus()
				return
			}

            if(frm.passport_first_name.value.trim() === ''){
                alert("请输入护照上登记的\"名字\"")
				frm.passport_first_name.focus()
				return
			}

            if(frm.passport_expire_date.value.trim() === ''){
                alert("请输入护照的到期日")
				frm.passport_expire_date.focus()
				return
			}

            if(!passport_chk){
                alert("请完成护照号码的重复核对")
				return;
			}

            frm.submit()
		}

    </script>
</body>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>