<?php

include("../_inc/head.php");

$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
if(!$member_idx){
	error_frame_go("请注意以下事项。", "../login/login.php");
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
            <div class="header__title">个人信息管理</div>
        </header>
        <main class="main">
            <div class="mypage__container mypage-edit">
                <form action="./mypage_edit_action.php" name="frm" method="post" target="_fra_admin">
					<input type="hidden" name="member_idx" value="<?=$member_idx?>">
                    <section class="join-info info-login">
                        <h3 class="join-info__title">基本信息</h3>
                        <div class="section__inner">
                            <div class="common-input__wrap">
                                <div class="common-box__input">
                                    <p class="join__sub-title">账号(邮箱号)</p>
                                    <input type="email" class="common-input" name="user_id" value="<?=$row['user_id']?>" placeholder="请输入邮箱号" readonly>
                                    <p class="edit__text"><span class="dot">&middot;</span> 更改账号时, 请咨询客服中心.</p>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">密码</p>
                                    <div class="input__inner">
                                        <input type="password" class="common-input" value="***********" readonly placeholder="请输入密码">
                                        <a href="/cn/mypage/mypage_pw.php" class="btn btn-radius btn-s">更改</a>
                                    </div>
                                    <!-- 유효성 검사 문구 addClass on 으로 노출 -->
                                    <!-- <span class="input-error__message">请组合英文、数字、特殊文字，共输入8个字以上</span> -->
                                </div> 
                                <div class="common-box__input">
                                    <p class="join__sub-title">姓名</p>
                                    <div class="input__inner name_input">
                                        <input type="text" class="common-input" name="user_last_name" value="<?=$row['user_last_name']?>" placeholder="姓" style="text-transform: none;">
                                        <input type="text" class="common-input" name="user_first_name" value="<?=$row['user_first_name']?>" placeholder="名字" style="text-transform: none;">
                                    </div>
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">出生年月日</p>
                                    <input type="text" class="common-input common-date-2" name="birthday" value="<?=$row['birthday']?>" placeholder="出生年月日(YYYY-MM-DD)">
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">性别</p>
                                    <div class="input__inner">
                                        <div class="common-box__input type-button">
                                            <label>
                                                <input type="radio" name="gender" value="1" class="common-radio" <?php if($row['gender'] == 1){ echo 'checked'; } ?>>
                                                女
                                            </label>
                                        </div>
                                        <div class="common-box__input type-button">
                                            <label>
                                                <input type="radio" name="gender" value="0" class="common-radio" <?php if($row['gender'] == 0){ echo 'checked'; } ?>>
                                                男
                                            </label>
                                        </div>
                                    </div> 
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">手机号</p>
                                    <div class="input__inner">
                                        <select name="phone_code" class="common-select">
                                            <option value="86" <?php if($row['phone_code'] == '86'){ echo 'selected'; } ?>>中国(86)</option>
                                            <option value="82" <?php if($row['phone_code'] == '82'){ echo 'selected'; } ?>>韩国(82)</option>
                                        </select>
                                        <input type="tel" class="common-input" name="phone_num" value="<?=$row['phone_num']?>" placeholder="010-1234-1234" oninput="autoHyphen2(this)" maxlength="13">
                                    </div>
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">WeChat ID</p>
                                    <input type="text" class="common-input" value="<?=$row['wechat_id']?>" placeholder="请输入账号" readonly>
                                    <p class="edit__text"><span class="dot">&middot;</span> 更改微信账号时, 请咨询客服中心.</p>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">新罗免税店 ID</p>
                                    <input type="text" class="common-input" value="<?=$row['shilla_id']?>" placeholder="请输入账号" readonly>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="join-info info-passport">
                        <h3 class="join-info__title">护照信息</h3>
                        <div class="section__inner">
                            <div class="common-input__wrap">
                                <div class="common-box__input">
                                    <p class="join__sub-title">护照英文名</p>
                                    <div class="input__inner name_input">
                                        <input type="text" class="common-input" value="<?=$row['passport_last_name']?>" placeholder="姓" readonly>
                                        <input type="text" class="common-input" value="<?=$row['passport_first_name']?>" placeholder="名字" readonly>
                                    </div>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">护照号码</p>
                                    <input type="text" class="common-input" value="<?=$row['passport_num']?>" placeholder="护照号码" readonly>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">护照期限</p>
                                    <input type="text" class="common-input common-date" value="<?=date('Y-m-d', strtotime($row['passport_expire_date']))?>" placeholder="YYYY-MM-DD" readonly>
                                    <p class="edit__text"><span class="dot">&middot;</span> 更改护照信息时, 请咨询客服中心.</p>
                                </div>
                            </div>
                            <div class="button__wrap">
                                <button type="button" onclick="go_submit()" class="btn btn-radius on">信息更改完成</button>
                            </div>
                            <p class="link__wrap"><a href="/cn/mypage/mypage_withdrawal.php">注销</a></p>
                        </div>
                    </section>
                </form>
            </div>
        </main>

        <?php include("../_inc/menu.php"); ?>

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