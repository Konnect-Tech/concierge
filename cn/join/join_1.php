<?php include("../_inc/head.php"); ?>

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
				<form action="../join/join_2.php" name="frm" method="post">
					<div class="join-input__top">
						<h2 class="join__title">本人认证&同意条款</h2>
						<p class="join__step"><span class="on">1</span><span>2</span></p>
					</div>
					<section class="join-form__wrap join-chk">
						<div class="section__inner">
							<div class="common-input__wrap">
								<div class="common-box__input">
									<p class="join__sub-title">认证邮件</p>
									<input type="email" class="common-input" name="email" placeholder="请输入邮箱号" onkeyup="email_regexp_validate(this)" onkeydown="email_regexp_validate(this)" onkeypress="email_regexp_validate(this)">
									<!-- 유효성 검사 문구 addClass on 으로 노출 -->
									<span class="input-error__message">电子邮件格式不对。 请重新输入</span>
								</div>
								<div class="common-box__input" style="display: none">
									<input type="number" class="common-input chk-num" name="verify_code" placeholder="输入验证码" maxlength="4" onkeyup="email_verify_code_match(this)" onkeydown="email_verify_code_match(this)" onkeypress="email_verify_code_match(this)">
									<span class="chk-time">30:00</span>
									<!-- 유효성 검사 문구 addClass on 으로 노출 -->
									<p class="chk-info">验证码已发送。 请在30分钟内输入</p>
									<span class="input-error__message">验证码不一致，请再确认一下</span>
								</div>
							</div>
							<div class="button__wrap join-chk">
								<button type="button" class="btn btn-radius off btn-send-code" onclick="email_check_press()">发送验证码</button>
								<button type="button" class="btn btn-radius on" style="display: none" onclick="email_verify_code_process_done()">确认验证码</button>
								<button type="button" class="btn btn-radius off" style="display: none" onclick="email_verify_code_resend()">再次发送验证码</button>
							</div>
							<button class="join-chk-text btn btn-radius off" style="display: none" disabled>已完成认证</button>
						</div>
					</section>
					<section class="join-agree__wrap">
						<div class="section__inner">
							<p class="join__sub-title">同意条款</p>
							<div class="join-agree">
								<div class="common-box__input checkbox all-chk">
									<label>
										<input type="checkbox" class="common-checkbox">
										<span>全部同意</span>
									</label>
								</div>
								<ul class="join-agree__list">
									<li>
										<div class="common-box__input checkbox">
											<label>
												<input type="checkbox" class="common-checkbox required">
												<span><b class="color--primary">(必须)</b> 满14岁以上</span>
											</label>
										</div>
									</li>
									<li>
										<div class="common-box__input checkbox">
											<label>
												<input type="checkbox" class="common-checkbox required">
												<span>
													<b class="color--primary">(必须)</b> 同意使用条款 
													<!-- 약관링크삽입예정 -->
													<a href="https://konnect-kct.notion.site/c36814ce543a4e799d1a2b99912e5173?pvs=4" target="_blank">[链接]</a>
												</span>
											</label>
										</div>
									</li>
									<li>
										<div class="common-box__input checkbox">
											<label>
												<input type="checkbox" class="common-checkbox required">
												<span>
													<b class="color--primary">(必须)</b> 同意个人信息收集及使用 
													<!-- 약관링크삽입예정 -->
													<a href="https://konnect-kct.notion.site/15495caa66b34a4690dfd1bc9ae36036" target="_blank">[链接]</a>
												</span>
											</label>
										</div>
									</li>
                                    <!--
									<li>
										<div class="common-box__input checkbox">
											<label>
												<input type="checkbox" class="common-checkbox required">
												<span>
													<b class="color--primary">(必须)</b> 同意向第三方提供个人信息
                                    -->
													<!-- 약관링크삽입예정 -->
                                    <!--
													<a href="#"></a>
												</span>
											</label>
										</div>
									</li>
                                    -->

									<li>
										<div class="common-box__input checkbox">
											<label>
												<input type="checkbox" class="common-checkbox">
												<span><b>(选择)</b> 活动及优惠通知 </span>
											</label>
										</div>
									</li>
								</ul>
							</div>
							<div class="button__wrap join-page">
								<a href="javascript:history.back()" class="btn btn-radius btn-prev">上一步</a>
								<button type="button" class="btn btn-radius btn-next" onclick="go_submit()">下一步</button>
							</div>
						</div>
					</section>
				</form>
			</div>
		</main>

		<!-- <?php //include("../_inc/menu.php"); ?> -->
	</div>


	<script>
        // 전체체크
        $(".all-chk .common-checkbox").on("click", (e) => {
            if ($(e.target).is(":checked")) {
                $(".join-agree__list .common-checkbox").prop("checked", true);
            } else {
                $(".join-agree__list .common-checkbox").prop("checked", false);
            }

        });

        $(".join-agree__list .common-checkbox").on("click", (e) => {
            const checkboxNum = $(".join-agree__list .common-checkbox").length;
            const isCheckboxNum = $(".join-agree__list .common-checkbox:checked").length;

            if (checkboxNum == isCheckboxNum) {
                $(".all-chk .common-checkbox").prop("checked", true);
            } else {
                $(".all-chk .common-checkbox").prop("checked", false);
            }
        });

        // 2023.09.07 yk >> document.querySelectorAll('.btn.btn-radius') -> document.querySelectorAll('.join-chk .btn.btn-radius'); 로 수정
        const button_slots = document.querySelectorAll('.join-chk .btn.btn-radius');
        const error_slots = document.querySelectorAll('.input-error__message');
        const EMAIL_REGEXP = /^[0-9a-zA-Z]([-_+\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_+\.]?[0-9a-zA-Z])*\.[a-zA-Z]/i;

        const fnFormattedTime = (seconds) => {
            let minutes = Math.floor(seconds / 60);
            let remainingSeconds = seconds % 60;
            return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`
        }

        let leftTime = 0;
        let verify_code = false;
        let scheduleHandler = false;

        function email_regexp_validate(element) {
            if (EMAIL_REGEXP.test(element.value)) {
                if (error_slots[0].classList.contains("on")) {
                    error_slots[0].classList.remove("on")
                }
                if(button_slots[0].classList.contains("off")) {
                    button_slots[0].classList.remove("off")
                }
            } else {
                if (!error_slots[0].classList.contains("on")) {
                    error_slots[0].classList.add("on")
                }
                if(!button_slots[0].classList.contains("off")) {
                    button_slots[0].classList.add("off")
                }
            }
        }

        function email_check_press(){
            if(frm.email.hasAttribute("readonly")){
                return
            }
            if (button_slots[0].classList.contains("off")) {
                frm.email.focus()
            }else{
                frm.email.setAttribute("readonly", "")
                email_verify_code_send()
            }

            add_loading_bar();
        }

        function add_loading_bar(){
            // 2023-10-16 퍼블 로딩이미지 추가
            document.querySelector(".btn-send-code").classList.add("btn-load");
            document.querySelector(".btn-send-code").innerText = "";
        }

        function remove_loading_bar(){
            document.querySelector(".btn-send-code").classList.remove("btn-load");
            document.querySelector(".btn-send-code").innerText = "发送验证码";
        }

        function email_verify_code_resend(){
            alert(' 验证码已重新发送了，请确认一下邮件')
            email_verify_code_send()
        }

        function email_verify_code_send(){

            //인증된 상태에서 재발송 누르면 인증 취소
            frm.verify_code.value = ''
            if(!button_slots[1].classList.contains("off")){
                button_slots[1].classList.add("off")
            }
            if (error_slots[1].classList.contains("on")) {
                error_slots[1].classList.remove("on")
            }

            $.ajax({
                url: "/ajax/ajax_email_verify_code.php",
                dataType: "json",
                type: "POST",
                data: {
                    email: frm.email.value,
                    template_path: "../cn/join/join_chk_email.html",
					title: "[KONNECT CS] 这是会员注册认证邮件。 "
                },
                success: function (response){
                    if(response.result_code === 1) {
                        button_slots[0].style.display = "none"
                        button_slots[1].style.display = "block"
                        button_slots[2].style.display = "block"
                        button_slots[2].classList.remove("off")
                        button_slots[2].classList.add("on")
                        document.querySelectorAll('.common-box__input')[1].style.display = "block"

                        if(scheduleHandler !== false){
                            clearInterval(scheduleHandler)
                            scheduleHandler = false;
                        }

                        verify_code = response.code;
                        leftTime = 1800;
                        scheduleHandler = setInterval(() => {
                            if (leftTime === 0) {
                                alert("认证时间已过。")
                                location.reload()
                            } else {
                                leftTime--;
                                document.querySelector('.chk-time').innerHTML = fnFormattedTime(leftTime)
                            }
                        }, 1000);
                    }else{
                        alert("使用该电子邮件注册的会员信息已存在。")
                        frm.email.removeAttribute("readonly")
                        remove_loading_bar()
                    }
                },

                error:function(request, status, error){

                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);

                }
            })
        }

        function email_verify_code_match(element){
            if(element.value === ""){
                document.getElementsByClassName('chk-info')[0].style.display = 'block'
                if (error_slots[1].classList.contains("on")) {
                    error_slots[1].classList.remove("on")
                }
            }else{
                document.getElementsByClassName('chk-info')[0].style.display = 'none'
                if (!error_slots[1].classList.contains("on")) {
                    error_slots[1].classList.add("on")
                }
                if(element.value == verify_code){
                    if(button_slots[1].classList.contains("off")){
                        button_slots[1].classList.remove("off")
                    }
                    if (error_slots[1].classList.contains("on")) {
                        error_slots[1].classList.remove("on")
                    }
                }else{
                    if(!button_slots[1].classList.contains("off")){
                        button_slots[1].classList.add("off")
                    }
                    if (!error_slots[1].classList.contains("on")) {
                        error_slots[1].classList.add("on")
                    }
                }
            }
        }

        function email_verify_code_process_done(){
            if(button_slots[1].classList.contains("off")){
                return
            }

            button_slots.forEach((v) => { v.style.display = "none" })

            document.querySelectorAll('.common-box__input')[1].style.display = "none"
            document.querySelector('.join-chk-text').style.display = 'flex'
        }

        function go_submit(){
            if(document.querySelector('.join-chk-text').style.display !== 'flex'){
                alert("请完成电子邮件的验证")
                return
            }

            if(document.querySelectorAll('.common-checkbox.required:checked').length !== 3){
                alert("您不同意某些强制性条款和条件。")
                return
            }

            frm.submit()
        }


	</script>
</body>
</html>