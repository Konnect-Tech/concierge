<?php include("../_inc/head.php"); ?>

<body>
	<div id="wrap">
		<header id="header">
			<div class="header__inner">
				<button type="button" class="btn_back"></button>
			</div>
			<div class="header__title">회원가입</div>
		</header>
		<main class="main">
			<div class="join__container">
				<form action="/join/join_2.php" name="frm" method="post">
					<div class="join-input__top">
						<h2 class="join__title">본인인증&약관동의</h2>
						<p class="join__step"><span class="on">1</span><span>2</span></p>
					</div>
					<section class="join-form__wrap join-chk">
						<div class="section__inner">
							<div class="common-input__wrap">
								<div class="common-box__input">
									<p class="join__sub-title">이메일 인증</p>
									<input type="email" class="common-input" name="email" placeholder="이메일을 입력해주세요" onkeyup="email_regexp_validate(this)" onkeydown="email_regexp_validate(this)" onkeypress="email_regexp_validate(this)">
									<!-- 유효성 검사 문구 addClass on 으로 노출 -->
									<span class="input-error__message">이메일 형식이 맞지 않습니다. 다시 입력해주세요</span>
								</div>
								<div class="common-box__input" style="display: none">
									<input type="number" class="common-input chk-num" name="verify_code" placeholder="인증코드 입력" maxlength="4" onkeyup="email_verify_code_match(this)" onkeydown="email_verify_code_match(this)" onkeypress="email_verify_code_match(this)">
									<span class="chk-time">30:00</span>
									<!-- 유효성 검사 문구 addClass on 으로 노출 -->
									<p class="chk-info">인증코드가 발송되었습니다. 30분 이내에 입력해주세요.</p>
									<span class="input-error__message">인증번호가 일치하지 않습니다. 다시 확인해주세요.</span>
								</div>
							</div>
							<div class="button__wrap join-chk">
								<button type="button" class="btn btn-radius off btn-send-code" onclick="email_check_press()">인증코드 발송</button>
								<button type="button" class="btn btn-radius on" style="display: none" onclick="email_verify_code_process_done()">인증코드확인</button>
								<button type="button" class="btn btn-radius off" style="display: none" onclick="email_verify_code_resend()">인증코드 재발송</button>
							</div>
							 <button class="join-chk-text btn btn-radius off" style="display: none" disabled>인증이 완료되었습니다.</button>
						</div>
					</section>
					<section class="join-agree__wrap">
						<div class="section__inner">
							<p class="join__sub-title">약관동의</p>
							<div class="join-agree">
								<div class="common-box__input checkbox all-chk">
									<label>
										<input type="checkbox" class="common-checkbox">
										<span>전체동의</span>
									</label>
								</div>
								<ul class="join-agree__list">
									<li>
										<div class="common-box__input checkbox">
											<label>
												<input type="checkbox" class="common-checkbox required">
												<span><b class="color--primary">(필수)</b> 만 14세 이상</span>
											</label>
										</div>
									</li>
									<li>
										<div class="common-box__input checkbox">
											<label>
												<input type="checkbox" class="common-checkbox required">
												<span>
													<b class="color--primary">(필수)</b> 이용약관 동의 
													<!-- 약관링크삽입예정 -->
													<a href="https://konnect-kct.notion.site/c36814ce543a4e799d1a2b99912e5173?pvs=4"><u>[링크]</u></a>
											</span>
											</label>
										</div>
									</li>
									<li>
										<div class="common-box__input checkbox">
											<label>
												<input type="checkbox" class="common-checkbox required">
												<span>
													<b class="color--primary">(필수)</b> 개인정보 수집 및 이용 동의 
													<!-- 약관링크삽입예정 -->
													<a href="https://konnect-kct.notion.site/15495caa66b34a4690dfd1bc9ae36036"><u>[링크]</u></a>
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
													<b class="color--primary">(필수)</b> 개인정보 제3자 제공 동의 
                                    -->
													<!-- 약관링크삽입예정 -->
									<!--
                                                    <a href="#">[링크]</a>
												</span>
											</label>
										</div>
									</li>
                                    -->
									<li>
										<div class="common-box__input checkbox">
											<label>
												<input type="checkbox" class="common-checkbox">
												<span><b>(선택)</b> 이벤트 및 혜택 알림 </span>
											</label>
										</div>
									</li>
								</ul>
							</div>
							<div class="button__wrap join-page">
								<a href="javascript:location.reload()" class="btn btn-radius btn-prev">이전</a>
								<button type="button" class="btn btn-radius btn-next" onclick="go_submit()">다음</button>
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
            document.querySelector(".btn-send-code").innerText = "인증코드 발송";
		}

        function email_verify_code_resend(){
            alert('인증코드가 재발송 되었습니다. 이메일을 확인해주세요.')
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
                    template_path: "../join/join_chk_email.html"
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
                                alert("인증 시간이 만료되었습니다.")
                                location.reload()
                            } else {
                                leftTime--;
                                document.querySelector('.chk-time').innerHTML = fnFormattedTime(leftTime)
                            }
                        }, 1000);
                    }else{
                        alert("해당 이메일로 가입된 회원 정보가 존재합니다.")
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
                alert("이메일 인증을 완료해주세요.")
				return
			}

            if(document.querySelectorAll('.common-checkbox.required:checked').length !== 3){
                alert("동의하지 않은 필수 약관이 있습니다.")
				return
			}

            frm.submit()
		}


	</script>
</body>
</html>