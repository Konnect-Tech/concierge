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
            <div class="header__title">我的页面</div>
        </header>
        <main class="main">
            <div class="mypage__container main">
                <section class="main-mypage">
                    <div class="section__inner">
                            <div class="mypage-member">
                                <div class="profile__img btn-modal" data-modal="profile">
									<img src="<?=$_P_DIR_WEB_FILE?>profile/<?=get_member_profile_img($member_idx)?>" alt="">
                                </div>
                                <a href="../mypage/mypage_check.php" class="mypage__link">
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
                        <h3 class="mypage__title">我的活动信息</h3>
                        <ul class="mypage-data__list">
                            <!-- <li>
                                <a href="./point_save.php" class="mypage__link">积分明细</a>
                            </li>
                            <li>
                                <a href="./amount_d.php" class="mypage__link">累计金额明细</a>
                            </li> -->
                            <li>
                                <a href="/cn/mypage/voucher_before_use.php" class="mypage__link">我的消费券</a>
                            </li>
                        </ul>
                    </div>
                </section>
                <section class="mypage-reserve">
                    <div class="section__inner">
                        <h3 class="mypage__title">预约明细</h3>
                        <ul class="mypage-data__list">
                            <li>
                                <a href="../mypage/reserve_medical.php" class="mypage__link">医疗服务预约明细</a>
                            </li>
                            <!-- <li>
                                <a href="../extra/extra_service.php" class="mypage__link">附加服务预约明细</a>
                            </li> -->
                        </ul>
                    </div>
                </section>
                <section class="mypage-banner">
                    <div class="section__inner">
                        <a href="../extra/extra_event.php">
                            <div class="banner__img">
                                <img src="/cn/_img/mypage/banner_img.png?123123" alt="">
                            </div> 
                        </a>
                    </div>
                </section>
                <!-- 2023.12.09 추가 -->
                <!-- <section class="mypage-reserve">
                    <div class="section__inner">
                        <h3 class="mypage__title">客户支持</h3>
                        <ul class="mypage-data__list">
                            <li>
                                <a href="https://konnect-kct.notion.site/c36814ce543a4e799d1a2b99912e5173?pvs=4" class="mypage__link" target="_blank">服务使用条款</a>
                            </li>
                            <li>
                                <a href="https://konnect-kct.notion.site/15495caa66b34a4690dfd1bc9ae36036" class="mypage__link" target="_blank">个人信息处理方针</a>
                            </li>
                        </ul>
                    </div>
                </section> -->
                <!-- 2023.09.18 추가 -->
                <section class="mypage-logout">
                    <div class="section__inner">
                        <a href="../login/logout.php">注销</a>
                    </div>
                </section>
            </div>
        </main>

		<!-- 프로필 변경 modal -->
		<div class="modal-layer" data-modal="profile">
			<div class="modal-layer__window">
				<div class="modal-header">
					<p>修改头像</p>
				</div>
				<div class="modal-body">
					<ul class="btn-profile__list">
						<li>
							<input type="file" class="input-profile" id="profile" accept="image/*">
							<label for="profile">从相册中选择</label>
						</li>
						<li>
							<a href="javascript:reset_profile_frm.submit();">更改为默认图像</a>
						</li>
					</ul>
				</div>
				<div class="button__wrap">
					<button type="button" class="btn btn-radius btn-close">关闭</button>
				</div>
			</div>
		</div>

        <?php include("../_inc/menu.php"); ?>
    </div>

	<form name="reset_profile_frm" method="post" action="./reset_profile_action.php" target="_fra_admin">
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
                            alert("您的头像已更改完成")
                            location.reload()
                        }else{
                            alert("会员登录后，即可使用")
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