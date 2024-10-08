<?php

include("../_inc/head.php");

$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
if(!$member_idx){
	error_frame_go("로그인 후 접근 가능한 페이지입니다.", "/login/login.php");
	exit;
}

$query = " SELECT * FROM member_info WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);
$row = $result->fetch_array();

?>

<body>

    <div id="wrap">
        <header id="header">
            <div class="header__inner">
                <button type="button" class="btn_back"></button>
            </div>
            <div class="header__title">내정보관리</div>
        </header>
        <main class="main">
            <div class="mypage__container mypage-edit">
                <form action="./mypage_edit_action.php" name="frm" method="post" target="_fra_admin">
					<input type="hidden" name="member_idx" value="<?=$member_idx?>">
                    <section class="join-info info-login">
                        <h3 class="join-info__title">기본 정보</h3>
                        <div class="section__inner">
                            <div class="common-input__wrap">
                                <div class="common-box__input">
                                    <p class="join__sub-title">아이디(이메일)</p>
                                    <input type="email" class="common-input" name="user_id" value="<?=$row['user_id']?>" placeholder="이메일을 입력해주세요" readonly>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">비밀번호</p>
                                    <div class="input__inner">
                                        <input type="password" class="common-input" value="***********" readonly placeholder="사용하실 비밀번호를 입력해주세요.">
                                        <a href="/mypage/mypage_pw.php" class="btn btn-radius btn-s">변경</a>
                                    </div>
                                    <!-- 유효성 검사 문구 addClass on 으로 노출 -->
                                    <!-- <span class="input-error__message">영문, 숫자, 특수문자를 조합하여 8자 이상 입력해주세요.</span> -->
                                </div> 
                                <div class="common-box__input">
                                    <p class="join__sub-title">성명</p>
                                    <div class="input__inner name_input">
                                        <input type="text" class="common-input" name="user_last_name" value="<?=$row['user_last_name']?>" placeholder="성" style="text-transform: none;">
                                        <input type="text" class="common-input" name="user_first_name" value="<?=$row['user_first_name']?>" placeholder="이름" style="text-transform: none;">
                                    </div>
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">생년월일</p>
                                    <input type="text" class="common-input common-date-2" name="birthday" value="<?=$row['birthday']?>" placeholder="생년월일(YYYY-MM-DD)">
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">성별</p>
                                    <div class="input__inner">
                                        <div class="common-box__input type-button">
                                            <label>
                                                <input type="radio" name="gender" value="1" class="common-radio" <?php if($row['gender'] == 1){ echo 'checked'; } ?>>
                                                여성
                                            </label>
                                        </div>
                                        <div class="common-box__input type-button">
                                            <label>
                                                <input type="radio" name="gender" value="0" class="common-radio" <?php if($row['gender'] == 0){ echo 'checked'; } ?>>
                                                남성
                                            </label>
                                        </div>
                                    </div> 
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">휴대폰 번호</p>
                                    <div class="input__inner">
                                        <select name="phone_code" class="common-select" onclick="autoHyphen2(phone_num)">
                                            <option value="86" <?php if($row['phone_code'] == '86'){ echo 'selected'; } ?>>중국(86)</option>
                                            <option value="82" <?php if($row['phone_code'] == '82'){ echo 'selected'; } ?>>한국(82)</option>
                                        </select>
                                        <input type="tel" class="common-input" name="phone_num" value="<?=$row['phone_num']?>" placeholder="010-1234-1234" oninput="autoHyphen2(this)" maxlength="13">
                                    </div>
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">WeChat ID</p>
                                    <input type="text" class="common-input" value="<?=$row['wechat_id']?>" placeholder="아이디를 입력해주세요" readonly>
                                    <p class="edit__text"><span class="dot">&middot;</span> 위챗 ID 변경 시, 고객센터로 문의해주세요</p>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">신라 면세점 ID</p>
                                    <input type="text" class="common-input" value="<?=$row['shilla_id']?>" placeholder="아이디를 입력해주세요" readonly>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="join-info info-passport">
                        <h3 class="join-info__title">여권 정보</h3>
                        <div class="section__inner">
                            <div class="common-input__wrap">
                                <div class="common-box__input">
                                    <p class="join__sub-title">영문명</p>
                                    <div class="input__inner name_input">
                                        <input type="text" class="common-input" value="<?=$row['passport_last_name']?>" placeholder="LAST NAME(성)" readonly>
                                        <input type="text" class="common-input" value="<?=$row['passport_first_name']?>" placeholder="FIRST NAME(이름)" readonly>
                                    </div>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">여권번호</p>
                                    <input type="text" class="common-input" value="<?=$row['passport_num']?>" placeholder="여권번호" readonly>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">여권만료일</p>
                                    <input type="text" class="common-input common-date" value="<?=date('Y-m-d', strtotime($row['passport_expire_date']))?>" placeholder="YYYY-MM-DD" readonly>
                                    <p class="edit__text"><span class="dot">&middot;</span> 여권정보 변경 시, 고객센터 문의해주세요.</p>
                                </div>
                            </div>
                            <div class="button__wrap">
                                <button type="button" onclick="go_submit()" class="btn btn-radius on">정보수정완료</button>
                            </div>
                            <p class="link__wrap"><a href="/mypage/mypage_withdrawal.php">회원탈퇴</a></p>
                        </div>
                    </section>
                </form>
            </div>
        </main>

        <?php include("../_inc/menu.php"); ?>

    </div>

    <!-- 모달 -->
    <div class="modal-layer" data-modal="confirm_1">
        <div class="modal-layer__window">
            <div class="modal-body">
                <p class="modal__text">사용가능한 번호입니다.</p>
            </div>
            <div class="button__wrap">
                <button type="button" class="btn btn-radius btn-close">확인</button>
            </div>
        </div>
    </div>

    <div class="modal-layer" data-modal="confirm_2">
        <div class="modal-layer__window">
            <div class="modal-body">
                <p class="modal__text">사용중인 여권번호입니다.<br>다시 확인해주세요.</p>
            </div>
            <div class="button__wrap">
                <button type="button" class="btn btn-radius btn-close">확인</button>
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
        
        // 전체체크
        $(".all-chk .common-checkbox").on("click",(e)=>{
            if($(e.target).is(":checked")){
                $(".join-agree__list .common-checkbox").prop("checked",true);
            }else{
                $(".join-agree__list .common-checkbox").prop("checked",false);
            }

        });

        $(".join-agree__list .common-checkbox").on("click",(e)=>{
            const checkboxNum = $(".join-agree__list .common-checkbox").length;
            const isCheckboxNum = $(".join-agree__list .common-checkbox:checked").length;

            if(checkboxNum == isCheckboxNum){
                $(".all-chk .common-checkbox").prop("checked",true);
            }else{
                $(".all-chk .common-checkbox").prop("checked",false);
            }
        });

        function go_submit(){
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

            if(frm.phone_num.value.length !== 13){
                alert("휴대폰 번호를 확인해주세요.")
                return;
            }

            frm.submit()
		}
    </script>
</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>