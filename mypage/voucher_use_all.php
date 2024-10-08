<?php

include("../_inc/head.php");

// $member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
// if(!$member_idx){
// 	error_frame_go("로그인 후 이용 가능한 페이지입니다.", "/login/login.php");
// 	exit;
// }

$type = trim(sqlfilter($_REQUEST['type']));
if(!$type){
	$type = "all";
}

?>

<body>
    <div id="wrap">
        <header id="header">
            <div class="header__inner">
                <button type="button" class="btn_back"></button>
            </div>
            <div class="header__title">나의 바우처</div>
        </header>
        <main class="main">
            <div class="mypage__container">
                <section class="mypage-point">
                    <ul class="point__list">
						<?php
						$currencies = [];
						if($type === "all"){
							$currencies = ["'M'", "'D'"];
						}elseif($type === "d"){
							$currencies = ["'D'"];
						}elseif($type === "m"){
							$currencies = ["'M'"];
						}

						$currency_query = "
						SELECT *
						FROM currency_info
						WHERE `member_idx` = '$member_idx' AND `amount` >= 0 AND `currency` IN (" . implode(', ', $currencies) . ")
						ORDER BY `idx` DESC
						";
						$currency_result = mysqli_query($gconnet, $currency_query);
						if(!$currency_result->num_rows){
							?>
							<!-- 이용내역이 없는 경우 -->
							<div class="no-list__wrap">
								<img src="/_img/mypage/no_point_img.png" alt="">
								<p>바우처 사용이 완료되었어요</p>
                                <p>커넥트 컨시어지의 다양한 이벤트를</p>
                                <p style="margin-top: 5px;">통해 더 많은 바우처를 획득하세요:)</p>
							</div>
						<?php
						}else{
							for($i = 0, $iMax = $currency_result->num_rows; $i < $iMax; $i ++){
								$currency_row = $currency_result->fetch_array();
								?>
								<li>
									<div class="point-content">
										<div class="point-info__wrap">
											<span class="point-date"><?=date('Y.m.d', strtotime($currency_row['wdate']))?></span>
											<span class="point-info"><?=$currency_row['source']?></span>
											<span class="point-save"><?=number_format($currency_row['etc'])?></span>
										</div>
										<p class="point-data">
											<span class="point-type point_<?=$currency_row['currency']?>"></span>
											<span class="point-amount"><?=number_format($currency_row['amount'])?> P</span>
										</p>
									</div>
								</li>
							<?php }
						}
						?>
                    </ul>
                </section>
            </div>
        </main>

        <?php include("../_inc/menu.php"); ?>

    </div>

    <script type="text/javascript">
        $(".point-category>a").on("click",function(){
            $(".point-category>a").removeClass("on");
            $(this).addClass("on");
        });
    </script>
</body>
</html>