<?php

include("../_inc/head.php");

$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
if(!$member_idx){
	error_frame_go("请注意以下事项。", "../login/login.php");
	exit;
}

$voucher_query = "
						SELECT *
						FROM member_info
						WHERE `idx` = '$member_idx'
						";
$voucher_result = mysqli_query($gconnet, $voucher_query);
$voucher_row = $voucher_result->fetch_array();

?>

<body>
    <div id="wrap">
        <header id="header">
            <div class="header__inner">
                <button type="button" class="btn_back"></button>
            </div>
            <div class="header__title">医疗服务 预约详情</div>
        </header>
        <main class="main">
        </main>

        <!-- 모달 -->
        <!-- <div class="modal-layer" data-modal="voucher">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <p class="modal__text">无法取消使用.<br>确定使用吗?</p>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">否</button>
                    <button type="button" class="btn btn-radius on" onclick="on_use_voucher()">使用</button>
                </div>
            </div>
        </div> -->

			<!-- 바우처 없음 모달 시작 -->
			<div class="modal-layer" data-modal="not-result">
			<div class="modal-layer__window">
				<div class="modal-body">
					<div class="modal-center__content">
						<p>
							没有预约明细
						</p>
					</div>
				</div>
				<div class="button__wrap">
					<button type="button" class="btn btn-radius" onclick="back()">关闭</button>
				</div>
			</div>
		</div>
		<!-- 바우처 없음 모달 끝 -->

        <?php include("../_inc/menu.php"); ?>

    </div>

	<script>
        function on_use_voucher(){
            $.ajax({
                url: "/ajax/ajax_use_voucher.php",
                dataType: "json",
                type: "POST",
                data: {
                    member_idx: "<?=$member_idx?>"
                },
                success: function (response){
                    if(response.result_code === 1){
                        location.reload()
                    }
                }
            })
        }
	</script>
	<script>
        window.onload = function(){
            document.querySelector('.modal-layer').classList.add('on')
        }
	</script>

	<script>
		function back(){
			window.location.href = "/cn/mypage/mypage_main.php"
		}
	</script>
</body>
</html>