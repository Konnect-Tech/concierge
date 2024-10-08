<?php

include("../_inc/head.php");

$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
if(!$member_idx){
	error_frame_go("로그인 후 접근 가능한 페이지입니다.", "/login/login.php");
	exit;
}

?>

<body>
    <div id="wrap">
        <header id="header">
            <div class="header__inner">
                <button type="button" class="btn_back"></button>
            </div>
            <div class="header__title">비밀번호 재확인</div>
        </header>
        <main class="main">
            <div class="mypage__container">
                <form action="./mypage_check_action.php" name="frm" method="post" target="_fra_admin">
					<input type="hidden" name="member_idx" value="<?=$member_idx?>">
                    <div class="join-input__top">
                        <p class="mypage-check__text">회원님의 소중한 정보보호를 위해<br>비밀번호를 재확인하고 있습니다.</p>
                    </div>
                    <section class="join-form__wrap">
                        <div class="section__inner">
                            <div class="common-input__wrap">
                                <div class="common-box__input">
                                    <p class="join__sub-title">아이디<span>(이메일)</span></p>
                                    <input type="email" class="common-input" name="user_id" placeholder="이메일을 입력해주세요" value="<?=$_SESSION[$_SESSION_DEFAULT_PREFIX . "id"]?>" readonly>
                                    <!-- 유효성 검사 문구 addClass on 으로 노출 -->
                                    <span class="input-error__message"></span>
                                </div>
                                <div class="common-box__input">
                                    <p class="join__sub-title">비밀번호</p>
                                    <input type="password" class="common-input" name="user_pwd" placeholder="비밀번호를 입력해주세요.">
                                    <!-- 유효성 검사 문구 addClass on 으로 노출 -->
                                    <span class="input-error__message"></span>
                                </div>
                            </div>
                            <div class="button__wrap">
                                <button type="submit" class="btn btn-radius on">확인</button>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </main>

        <?php include("../_inc/menu.php"); ?>

    </div>
</body>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>

</html>