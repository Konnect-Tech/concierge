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
            <div class="header__title">마이페이지</div>
        </header>
        <main class="main">
            <div class="mypage__container main">
                <section class="main-mypage">
                    <div class="section__inner">
                        <h2 class="screen--out">내 정보</h2>
                            <div class="mypage-member">
                                <div class="profile__img btn-modal" data-modal="profile">
									<img src="<?=$_P_DIR_WEB_FILE?>profile/<?=get_member_profile_img($member_idx)?>" alt="">
                                </div>
                                <a href="/mypage/mypage_check.php" class="mypage__link">
                                    <div class="name__wrap">
                                        <p class="nickname" style="padding-bottom: 4px;"><?=$_SESSION[$_SESSION_DEFAULT_PREFIX . "name"]?></p>
                                        <p class="id-number"><?=$_SESSION[$_SESSION_DEFAULT_PREFIX . "code"]?></p>
                                        <p class="code"></p>
                                    </div>
                                </a>
                            </div>
                    </div>
                </section>
                <section class="mypage-data">
                    <div class="section__inner">
                        <h3 class="mypage__title">나의 활동정보</h3>
                        <ul class="mypage-data__list">
                            <!-- <li>
                                <a href="/mypage/point_save.php" class="mypage__link">포인트 내역</a>
                            </li>
                            <li>
                                <a href="/mypage/amount_d.php" class="mypage__link">누적 금액 내역</a>
                            </li> -->
                            <li>
                                <a href="/mypage/voucher_before_use.php" class="mypage__link">나의 바우처</a>
                            </li>
                            <li>
                                <a href="/mypage/offline_voucher.php" class="mypage__link">오프라인 바우처</a>
                            </li>
                        </ul>
                    </div>
                </section>
                <section class="mypage-reserve">
                    <div class="section__inner">
                        <h3 class="mypage__title">예약내역</h3>
                        <ul class="mypage-data__list">
                            <li>
                                <a href="/mypage/reserve_medical.php" class="mypage__link btn_reserv">메디컬 서비스 예약 내역</a>
                            </li>
                            <!-- <li>
                                <a href="/extra/extra_service.php" class="mypage__link">부가서비스 예약 내역</a>
                            </li> -->
                        </ul>
                    </div>
                </section>
                <section class="mypage-banner">
                    <div class="section__inner">
                        <a href="../extra/extra_event.php">
                            <div class="banner__img">
                                <img src="/_img/mypage/banner_img.png?12322" alt="">
                            </div> 
                        </a>
                    </div>
                </section>
                <!-- <section class="mypage-reserve">
                    <div class="section__inner">
                        <h3 class="mypage__title">고객지원</h3>
                        <ul class="mypage-data__list">
                            <li>
                                <a href="" class="mypage__link">이용약관</a>
                            </li>
                            <li>
                                <a href="" class="mypage__link">개인정보처리방침</a>
                            </li>
                        </ul>
                    </div>
                </section> -->
                <!-- 2023.09.18 추가 -->
                <section class="mypage-logout" style="text-align:right">
                    <div class="section__inner">
                        <a href="../login/logout.php">로그아웃</a>
                    </div>
                </section>
            </div>
        </main>

		<!-- 프로필 변경 modal -->
		<div class="modal-layer" data-modal="profile">
			<div class="modal-layer__window">
				<div class="modal-header">
					<p>프로필 사진 수정</p>
				</div>
				<div class="modal-body">
					<ul class="btn-profile__list">
						<li>
							<input type="file" class="input-profile" id="profile" accept="image/*">
							<label for="profile">프로필 변경</label>
						</li>
						<li>
							<a href="javascript:reset_profile_frm.submit();">기본 이미지로 변경</a>
						</li>
					</ul>
				</div>
				<div class="button__wrap">
					<button type="button" class="btn btn-radius btn-close">닫기</button>
				</div>
			</div>
		</div>

        <?php include("../_inc/menu.php"); ?>
    </div>

	<form name="reset_profile_frm" method="post" action="/mypage/reset_profile_action.php" target="_fra_admin">
		<input type="hidden" name="member_idx" value="<?=$member_idx?>">
	</form>

	<script>
        document.querySelectorAll('.input-profile').forEach((element) => {
            element.addEventListener('change', function (){
                if(element.files.length === 0){
                    return
                }

                const formData = new FormData();
                formData.append("file", element.files[0])
                formData.append("member_idx", '<?=$member_idx?>')

                $.ajax({
                    url: "/ajax/ajax_member_profile_change.php",
                    dataType: "json",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response){
                        if(response.code === 1){
                            alert("프로필 이미지를 정상적으로 변경했습니다.")
                            location.reload()
                        }else{
                            alert("프로필 이미지 변경 도중에 알 수 없는 오류가 발생했습니다.")
                        }
                    }
                })
            })
        })
	</script>

    <script>

        $.ajax({
            type: "GET",
            url: "https://concierge.fourdpocket.com/api/v1/member/findByConciergeId/<?=$member_idx?>",
            success: function (res) {
                console.log(res)
                if(res.uniqueCode != undefined)
                $('.code').append('<p>'+res.uniqueCode+'</p>')
                console.log(res.uniqueCode)
            }
        });
    </script>

</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>