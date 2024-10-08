<?php

include("../_inc/head.php");

$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
if(!$member_idx){
	error_frame_go("로그인 후 이용 가능한 페이지입니다.", "/login/login.php");
	exit;
}

?>

<body>
    <div id="wrap">
        <header id="header">
            <div class="header__inner">
                <button type="button" class="btn_back"></button>
            </div>
            <div class="header__title">누적구매현황</div>
        </header>
        <main class="main">
            <div class="mypage__container">
                <section class="mypage-point">
                    <div class="mypage-tab">
                        <a href="/mypage/amount_d.php" class="tab">면세점</a>
                        <a href="/mypage/amount_m.php" class="tab on">메디컬</a>
                    </div>
                    <div class="amount__area">
                        <div class="amount__box">
							<?php
							$info_query = "
							SELECT COALESCE(SUM(ci.amount), 0) AS total_amount
							FROM buy_history_info bhi
							LEFT JOIN currency_info ci ON bhi.currency_idx = ci.idx AND ci.member_idx = '$member_idx'
							WHERE bhi.type = 1 AND ci.member_idx IS NOT NULL;
							";
							$info_result = mysqli_query($gconnet, $info_query);
							$info_row = $info_result->fetch_array();
							?>
                            <span>현재 누적금액</span>
                            <span><?=number_format($info_row['total_amount'])?>원</span>
                        </div>
						<p>업데이트 일자 : <?=date('Y.m.d', strtotime($info_row['wdate'] ?? date('Y-m-d')))?></p>
                    </div>
                    <ul class="point__list">
						<?php
						$query = "
						SELECT bhi.gubun, bhi.subject, ci.amount, bhi.date
						FROM buy_history_info bhi
						LEFT JOIN currency_info ci ON bhi.currency_idx = ci.idx AND ci.member_idx = '$member_idx'
						WHERE bhi.type = 1 AND ci.member_idx IS NOT NULL
						ORDER BY bhi.idx DESC
						";
						$result = mysqli_query($gconnet, $query);
						if(!$result->num_rows){
							?>
							<!-- 이용내역이 없는 경우 -->
							<div class="no-list__wrap">
								<img src="/_img/mypage/no_point_img.png" alt="">
								<p>현재 업데이트 된 구매 내역이 없습니다.</p>
							</div>
							<?php
						}else{
							for($i = 0, $iMax = $result->num_rows; $i < $iMax; $i ++){
								$row = $result->fetch_array();
								?>
								<li>
									<div class="point-content">
										<div class="point-info__wrap">
											<span class="point-date"><?=date('Y.m.d', strtotime($row['date']))?></span>
											<span class="point-info"><?=$row['gubun']?></span>
											<span class="point-save"><?=$row['subject']?></span>
										</div>
										<p class="point-data amount">
											<span class="point-amount"><?=number_format($row['amount'])?></span>
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
</body>
</html>