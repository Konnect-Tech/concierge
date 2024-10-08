<?php include("../_inc/head.php"); ?>

<?php

$hospital_type = trim(sqlfilter($_REQUEST['hospital_type']));

$where = " 1 = 1 ";
if($hospital_type){
	$where .= " AND ( `hospital_type` = '$hospital_type' ";
	if($hospital_type === "피부과"){
		$where .= " OR `hospital_type` = '皮肤科' ";
	}
	if($hospital_type === "성형외과"){
		$where .= " OR `hospital_type` = '整形医院' ";
	}
	if($hospital_type === "산부인과"){
		$where .= " OR `hospital_type` = '妇产科' ";
	}
	if($hospital_type === "안과"){
		$where .= " OR `hospital_type` = '眼科' ";
	}
	if($hospital_type === "치과"){
		$where .= " OR `hospital_type` = '牙医' ";
	}
	$where .= " ) ";
}

$voucher_query = " SELECT used_voucher,voucher_state FROM member_info WHERE `user_id` = '" . $_SESSION[$_SESSION_DEFAULT_PREFIX . "id"] . "' ";
$voucher_result = mysqli_query($gconnet, $voucher_query);
$voucher_row = $voucher_result->fetch_array();

?>

<body>
	<div id="wrap">
		<header id="header">
			<div class="header__title">프로모션</div>
		</header>
		<main class="main">
			<div id="container" class="promotion_container">
				<div class="promotion__inner">
					<div class="alert">
						<p>원활한 진료를 위해 최소 일주일 전에는 예약해주세요.</p>
					</div>
					<div class="promotion_tab">
						<div class="swiper promotion_swiper">
							<div class="swiper-wrapper">
								<div class="swiper-slide <?php if(!$hospital_type){ echo 'active'; } ?>" onclick="location.href = './<?=basename($_SERVER['PHP_SELF'])?>?hospital_type='">
									<div class="tab">전체</div>
								</div>
								<div class="swiper-slide <?php if($hospital_type == '피부과'){ echo 'active'; } ?>" onclick="location.href = './<?=basename($_SERVER['PHP_SELF'])?>?hospital_type=피부과'">
									<div class="tab">피부과</div>
								</div>
								<div class="swiper-slide <?php if($hospital_type == '성형외과'){ echo 'active'; } ?>" onclick="location.href = './<?=basename($_SERVER['PHP_SELF'])?>?hospital_type=성형외과'">
									<div class="tab">성형외과</div>
								</div>
								<div class="swiper-slide <?php if($hospital_type == '산부인과'){ echo 'active'; } ?>" onclick="location.href = './<?=basename($_SERVER['PHP_SELF'])?>?hospital_type=산부인과'">
									<div class="tab">산부인과</div>
								</div>
								<div class="swiper-slide <?php if($hospital_type == '안과'){ echo 'active'; } ?>" onclick="location.href = './<?=basename($_SERVER['PHP_SELF'])?>?hospital_type=안과'">
									<div class="tab">안과</div>
								</div>
								<div class="swiper-slide <?php if($hospital_type == '치과'){ echo 'active'; } ?>" onclick="location.href = './<?=basename($_SERVER['PHP_SELF'])?>?hospital_type=치과'">
									<div class="tab">치과</div>
								</div>
							</div>
						</div>
						<div class="promotion__list">
							<?php

							$promotion_query = " SELECT * FROM promotion_info WHERE $where ORDER BY idx DESC ";
							$promotion_result = mysqli_query($gconnet, $promotion_query);
							for($i = 0, $iMax = $promotion_result->num_rows; $i < $iMax; $i ++){
								$row = $promotion_result->fetch_array();
								?>
								<div class="promotion__item">
									<img src="<?=$_P_DIR_WEB_FILE?>promotion/<?=$row['banner_file_chg']?>" alt="" class="promotion__img">
									<div class="promotion_info">
										<div class="tit">
											<span><?=$row['hospital_type']?></span>
											<h3><?=nl2br($row['procedure'])?></h3>
										</div>
										<!-- <span class="limit"><?=$row['amount']?><small>LIMITED</small></span> -->
										<div class="limit__img">
											<img src="../_img/common/limit_100.png" alt="">
										</div>
									</div>
									<div class="promotion_btn">
										<span class="hospital"><?=$row['hospital']?></span>
										<div class="btns">
											<?php if($row['amount'] > 0 && isset($_SESSION[$_SESSION_DEFAULT_PREFIX . "id"]) && count(get_reservations($_SESSION[$_SESSION_DEFAULT_PREFIX . "id"])) === 0){ ?>
												<?php if($voucher_row['used_voucher'] == 1 || $voucher_row['voucher_state'] == 0){ ?>
													<a href="javascript:modalLayerOpen()" class="btn_reserv">예약하기</a>
												<?php }elseif($voucher_row['voucher_state'] == 1){ ?>
													<a href="./chk_go_promo.php?promotion_code=<?=$row['code']?>" class="btn_reserv">예약하기</a>
												<?php } ?>
											<?php } ?>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</main>
		<!-- 바우처 없음 모달 시작 -->
		<div class="modal-layer" data-modal="not-result">
			<div class="modal-layer__window">
				<div class="modal-body">
					<div class="modal-center__content">
						<p>
							보유하신 바우처가 없습니다.
						</p>
					</div>
				</div>
				<div class="button__wrap">
					<button type="button" class="btn btn-radius btn-close">확인</button>
				</div>
			</div>
		</div>
		<!-- 바우처 없음 모달 끝 -->
		<?php include("../_inc/menu.php"); ?>
	</div>
	<script>
		$(function () {
            var swiper = new Swiper(".promotion_swiper", {
                slidesPerView: "auto",
                spaceBetween: 10,
            });
        })

        function modalLayerOpen(){
            document.querySelector('.modal-layer').classList.add('on')
        }
	</script>
</body>
</html>