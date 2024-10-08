<?php

include("../_inc/head.php");

$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
if(!$member_idx){
	error_frame_go("로그인 후 이용 가능한 페이지입니다.", "/login/login.php");
	exit;
}

?>

<body>
	<form method="post" name="frm" target="_fra_admin" action="./mypage_withdrawal_action.php">
		<input type="hidden" name="member_idx" value="<?=$member_idx?>">
	</form>

    <div id="wrap">
        <header id="header">
            <div class="header__inner">
                <button type="button" class="btn_back"></button>
            </div>
            <div class="header__title">회원탈퇴</div>
        </header>
        <main class="main">
            <div class="mypage__container">
                <section class="withdrawal__wrap">
                    <div class="section__inner">
                        <p class="withdrawal__title"><em>탈퇴 전 확인해주세요</em></p>
                        <ul class="withdrawal__list">
                            <li><span class="dot">&middot;</span>탈퇴 시 모든 회원 혜택은 자동으로 소멸됩니다. (포인트, 바우처 등)</li>
                            <li><span class="dot">&middot;</span>탈퇴 후에는 서비스 이용 및 조회가 불가하며 동일한 아이디로 재가입이 불가합니다.</li>
                            <li><span class="dot">&middot;</span>재가입 시 신규회원 혜택은 제공되지 않습니다.</li>
                        </ul>
                        <div class="button__wrap">
                            <button type="button" class="btn btn-radius on" onclick="frm.submit()">탈퇴하기</button>
                        </div>
                    </div>
                </section>

                <!-- 모달 -->
                <div class="modal-layer" data-modal="confirm">
                    <div class="modal-layer__window">
                        <div class="modal-body">
                            <p class="modal__text">탈퇴처리가 완료되었습니다.<br>서비스를 이용해주셔서 감사합니다.</p>
                        </div>
                        <div class="button__wrap">
                            <a href="/login/login.php" class="btn btn-radius btn-close">확인</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>

	<script>
        function modalLayerOpen(){
            document.querySelector('.modal-layer').classList.add('on')
        }
	</script>
</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>