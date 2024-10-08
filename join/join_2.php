<?php

include("../_inc/head.php");

$email = trim(sqlfilter($_REQUEST['email']));
if(!$email){
	error_frame_go("개별 접근 불가능한 페이지입니다.", "./join_1.php");
	exit;
}

if($member_idx) {
    $query = " SELECT * FROM member_info WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);
$row = $result->fetch_array();

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
            <div class="header__title">회원가입</div>
        </header>
        <main class="main">
            <div class="join__container">
                <form action="./join_write_action.php" method="post" name="frm" target="_fra_admin">
                    <div class="join-input__top step-2">
                        <h2 class="join__title">회원 가입 정보</h2>
                        <p class="join__step"><span>1</span><span class="on">2</span></p>
                    </div>
                    <section class="join-info info-login">
                        <h3 class="join-info__title">로그인 정보</h3>
                        <div class="section__inner">
                            <div class="common-input__wrap">
                                <div class="common-box__input">
                                    <p class="join__sub-title">아이디<span>(이메일)</span></p>
                                    <input type="email" class="common-input" name="email" value="<?=$email?>" readonly placeholder="이메일을 입력해주세요">
                                    <!-- 유효성 검사 문구 addClass on 으로 노출 -->
                                    <span class="input-error__message">이메일 형식이 맞지 않습니다. 다시 입력해주세요</span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">비밀번호</p>
                                    <input type="password" class="common-input" name="password" placeholder="사용하실 비밀번호를 입력해주세요." onkeydown="input_password(this)" onkeyup="input_password(this)" onkeypress="input_password(this)">
                                    <!-- 유효성 검사 문구 addClass on 으로 노출 -->
                                    <span class="input-error__message">영문, 숫자, 특수문자를 조합하여 8자 이상 입력해주세요.</span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">비밀번호 확인</p>
                                    <input type="password" class="common-input" name="password_chk" placeholder="한번 더 입력해주세요." onkeyup="input_password_chk(this)" onkeypress="input_password_chk(this)" onkeydown="input_password_chk(this)">
                                    <!-- 유효성 검사 문구 addClass on 으로 노출 -->
                                    <span class="input-error__message">비밀번호를 다시 확인해주세요.</span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="join-info info-basic">
                        <h3 class="join-info__title">기본 정보</h3>
                        <div class="section__inner">
                            <div class="common-input__wrap">
                                <div class="common-box__input">
                                    <p class="join__sub-title">성명</p>
                                    <div class="input__inner name_input">
                                        <input type="text" class="common-input" name="user_last_name" placeholder="성" style="text-transform: none;">
                                        <input type="text" class="common-input" name="user_first_name" placeholder="이름" style="text-transform: none;">
                                    </div>
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">생년월일</p>
                                    <input type="text" class="common-input common-date-2" name="birthday" placeholder="생년월일(YYYY-MM-DD)">
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">성별</p>
                                    <div class="input__inner">
                                        <div class="common-box__input type-button">
                                            <label>
                                                <input type="radio" name="gender" value="1" class="common-radio" checked>
                                                여성
                                            </label>
                                        </div>
                                        <div class="common-box__input type-button">
                                            <label>
                                                <input type="radio" name="gender" value="0" class="common-radio">
                                                남성
                                            </label>
                                        </div>
                                    </div> 
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">휴대폰 번호</p>
                                    <div class="input__inner">
                                        <select name="phone_code" class="common-select" onchange="autoHyphen2(phone_num)">
                                            <option value="86">중국(86)</option>
                                            <option value="82">한국(82)</option>
                                        </select>
                                        <input type="tel" class="common-input" name="phone_num" placeholder="010-1234-1234" oninput="autoHyphen2(this)" maxlength="13">
                                    </div> 
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">WeChat ID</p>
                                    <input type="text" class="common-input" name="wechat_id" placeholder="아이디를 입력해주세요">
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">신라 면세점 ID</p>
                                    <input type="text" class="common-input" name="shilla_id" placeholder="아이디를 입력해주세요">
                                    <span class="input-error__message"></span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="join-info info-passport">
                        <h3 class="join-info__title">여권 정보</h3>
                        <div class="section__inner">
                            <div class="common-input__wrap">
                                <ul class="info-passport__list">
                                    <li><span class="dot">&middot;</span>출국여권상 여권번호와 일치하지 않는 경우는 혜택 지급이 불가능하오니 정확히 입력해 주세요.</li>
                                    <li><span class="dot">&middot;</span>여권번호는 혜택 지급 확인시 사용되므로 정확하게 입력해 주세요.</li>
                                    <li><span class="dot">&middot;</span>영문'O'와 숫자'0'을 정확히 구분하여 입력해 주세요.</li>
                                </ul>
                                <div class="common-box__input">
                                    <p class="join__sub-title">여권 영문명</p>
                                    <div class="input__inner name_input">
                                        <input type="text" class="common-input" name="passport_last_name" placeholder="LAST NAME(성)" oninput="handleOnInput(this)">
                                        <input type="text" class="common-input" name="passport_first_name" placeholder="FIRST NAME(이름)" oninput="handleOnInput(this)">
                                    </div>
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">여권번호</p>
                                    <div class="input__inner">
                                        <input type="text" class="common-input" name="passport_num" placeholder="여권번호" data-modal="confirm_2">
                                        <button type="button" class="btn btn-radius btn-s" onclick="passport_num_validate()">중복체크</button>
                                    </div>
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">여권만료일</p>
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
                                    <p class="join__sub-title mb0">개인정보 유효기간</p>
                                    <p class="info-personal__text">개인정보 유효기간 경과 이후 개인정보를 분리 저장/관리 또는 파기합니다.</p>
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <div class="input__inner">
                                        <div class="common-box__input radio">
                                            <label>
                                                <input type="radio" name="data_type" value="0" class="common-radio" checked>
                                                회원 탈퇴시까지
                                            </label>
                                        </div>
                                        <div class="common-box__input radio">
                                            <label>
                                                <input type="radio" name="data_type" value="1" class="common-radio">
                                                1년
                                            </label>
                                        </div>
                                    </div> 
                                    <span class="input-error__message"></span>
                                </div>
                            </div>
                            <p class="join-info__text">가입 버튼을 누르시면,<br>회원가입이 완료되며 자동으로 로그인 됩니다.</p>
                            <div class="button__wrap">
                                <a href="javascript:location.reload();" class="btn btn-radius btn-prev">이전</a>
                                <button type="button" class="btn btn-radius btn-next" onclick="go_submit()">가입</button>
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
                <p class="modal__text">사용가능한 번호입니다.</p>
            </div>
            <div class="button__wrap">
                <button type="button" class="btn btn-radius btn-focus">확인</button>
            </div>
        </div>
    </div>

    <div class="modal-layer" data-modal="confirm_2">
        <div class="modal-layer__window">
            <div class="modal-body">
                <p class="modal__text">사용중인 여권번호입니다.<br>다시 확인해주세요.</p>
            </div>
            <div class="button__wrap">
                <button type="button" class="btn btn-radius btn-focus">확인</button>
            </div>
        </div>
    </div>

    <script>
        function handleOnInput(e) {
            e.value = e.value.replace(/[^A-Za-z]/ig, '')
        }

        const autoHyphen2 = (target) => {
            if(frm.phone_code.value == 82){
                target.value = target.value
                    .replace(/[^0-9]/g, '')
                    .replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3").replace(/(\-{1,2})$/g, "");
			}else{
                target.value = target.value
                    .replace(/[^0-9]/g, '')
                    .replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3").replace(/(\-{1,2})$/g, "");
            }
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
                alert("여권 번호를 입력해주세요.")
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
                alert("비밀번호는 영문, 숫자, 특수문자를 조합하여 8자 이상 입력해주세요.")
				frm.password.focus()
				return
			}

            if(frm.password_chk.value !== frm.password.value){
                alert("비밀번호가 일치하지 않습니다. 다시 입력해주세요. ")
				frm.password_chk.focus()
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

            if(frm.birthday.value.trim() === ''){
                alert("생년월일을 선택해주세요.")
				frm.birthday.focus()
				return
			}

            if(frm.phone_num.value.trim() === ''){
                alert("휴대폰 번호를 입력해주세요.")
				frm.phone_num.focus()
				return
			}

            if(frm.wechat_id.value.trim() === ''){
                alert("WeChat ID를 입력해주세요.")
				frm.wechat_id.focus()
				return
			}

            if(frm.shilla_id.value.trim() === ''){
                alert("신라 면세점 ID를 입력해주세요.")
				frm.shilla_id.focus()
				return
			}

            if(frm.passport_last_name.value.trim() === ''){
                alert("여권 영문명 성을 입력해주세요.")
				frm.passport_last_name.focus()
				return
			}

            if(frm.passport_first_name.value.trim() === ''){
                alert("여권 영문명 이름을 입력해주세요.")
				frm.passport_first_name.focus()
				return
			}

            if(frm.passport_expire_date.value.trim() === ''){
                alert("여권 만료일을 선택해주세요.")
				frm.passport_expire_date.focus()
				return
			}

            if(!passport_chk){
                alert("여권번호 중복체크를 완료해주세요.")
				return;
			}

            if(frm.phone_num.value.length !== 13){
                alert("휴대폰 번호를 확인해주세요.")
				return;
			}

            frm.submit()

            // 회원가입 바우처 생성 포스트
            // var request = $.ajax({
            //     type: 'POST',
            //     data: {externalId:"2" ,memberId:"2", name:frm.user_first_name+frm.user_last_name, passportNum:frm.passportNum},
            //     url: 'https://api.kbeautyfree.com/api/v1/voucherin/signInVoucher',
            //     contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            //     dataType: "json",
            //     success:function(result){
            //         console.log(result)
            //     }
            // });

		}

    </script>
</body>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>