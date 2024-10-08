<?php include("../_inc/head.php"); ?>

<?php

$idx = trim(sqlfilter($_REQUEST['idx']));
if(!$idx){
	error_back("请注意。");
	exit;
}

$query = " SELECT * FROM promotion_info WHERE `idx` = '$idx' ";
$result = mysqli_query($gconnet, $query);
$row = $result->fetch_array();

$voucher_query = " SELECT used_voucher,voucher_state FROM member_info WHERE `user_id` = '" . $_SESSION[$_SESSION_DEFAULT_PREFIX . "id"] . "' ";
$voucher_result = mysqli_query($gconnet, $voucher_query);
$voucher_row = $voucher_result->fetch_array();

//$hospitals = get_hospitals('name', 'address', static function(array $data): array{ return ["name" => $data['name'], "address" => [[$data['i18n'][0]['roadAddress'], $data['i18n'][0]['roadAddressDetail']], [$data['i18n'][1]['roadAddress'], $data['i18n'][1]['roadAddressDetail']]]]; });
//$hospital_data = $hospitals[$row['hospital']];

?>

<body>
	<div id="wrap" class="promotion-page">
		<header id="header">
			<div class="header__inner">
				<button type="button" class="btn_back"></button>
			</div>
			<div class="header__title">促销活动详情</div>
		</header>
		<main class="main">
			<div id="container" class="promotion_container">
				<div class="promotion-dtl__inner">
					<section class="header">
						<img src="<?=$_P_DIR_WEB_FILE?>promotion/<?=$row['banner_file_chg']?>" alt="" class="promotion__img">
						<div class="dtl-header_info">
							<span class="cate"><?=$row['hospital_type']?></span>
							<h2><?=nl2br($row['procedure'])?></h2>
							<span class="hospital"><?=$row['hospital']?>(<?=$row['location']?>)</span>
						</div>
						<!-- <span class="limit"><?=$row['amount']?><small>LIMITED</small></span> -->
						<div class="limit__img">
							<img src="../_img/common/limit_100.png" alt="">
						</div>			
					</section>
					<section class="dtl_info">
						<div class="info">
							<h3 class="dtl_title">促销活动详情</h3>
						</div>
						<div class="main_img">
							<?php
							$procedure_query = " SELECT * FROM promotion_image_list WHERE `promotion_idx` = '$idx' AND `type` = 'procedure' ";
							$procedure_result = mysqli_query($gconnet, $procedure_query);
							for($i = 0, $iMax = $procedure_result->num_rows; $i < $iMax; $i ++){
								$procedure_row = $procedure_result->fetch_array();
								?>
								<img src="<?=$_P_DIR_WEB_FILE?>promotion/<?=$procedure_row['file_chg']?>" alt="">
							<?php } ?>
						</div>
						<div class="about_brand">
							<span>ABOUT BRAND</span>
							<div class="company_logo">
								<img src="<?=$_P_DIR_WEB_FILE?>promotion/<?=$row['logo_file_chg']?>" alt="">
							</div>
						</div>
<!--						<div class="promo-info">-->
<!--							<div class="dtl_img">-->
<!--								<img src="--><?php //=$_P_DIR_WEB_FILE?><!--promotion/--><?php //=$row['procedure_file_chg']?><!--" alt="">-->
<!--							</div>	-->
<!--						</div>-->
						<div class="info">
							<h3 class="dtl_title">医院信息</h3>
							<div class="dtl_content"><?=nl2br($row['hospital_info'])?></div>
						</div>
						<div class="info">
							<h3 class="dtl_title">主要施术 <span>(诊疗项目介绍)</span></h3>
							<div class="dtl_content">
								<?=nl2br($row['major_procedures'])?>
							</div>
						</div>
						<div class="info">
							<h3 class="dtl_title">运营时间</h3>
							<div class="dtl_content">
								<?=nl2br($row['operating_time'])?>
							</div>
						</div>
						<div class="info">
							<h3 class="dtl_title">医院地址</h3>
							<div class="dtl_content">
								<ul class="dtl_list">
<!--									<li>--><?php //=implode(' ', $hospital_data[0])?><!--</li>-->
<!--									<li>--><?php //=implode(' ', $hospital_data[1])?><!--</li>-->
									<?=nl2br($row['hospital_pos'])?>
								</ul>
								<div class="dtl_img-list">
									<img src="<?=$_P_DIR_WEB_FILE?>promotion/<?=$row['hospital_in_file_chg']?>" alt="병원사진">
									<img src="<?=$_P_DIR_WEB_FILE?>promotion/<?=$row['hospital_view_file_chg']?>" alt="병원사진">
								</div>
							</div>
						</div>
						<div class="info">
							<h3 class="dtl_title">医院后记</h3>
							<div class="review_list">
								<div class="review_item">
									<?php
									$review_query = " SELECT * FROM promotion_image_list WHERE `promotion_idx` = '$idx' AND `type` = 'review' ";
									$review_result = mysqli_query($gconnet, $review_query);
									for($i = 0, $iMax = $review_result->num_rows; $i < $iMax; $i ++){
										$review_row = $review_result->fetch_array();
										?>
										<img src="<?=$_P_DIR_WEB_FILE?>promotion/<?=$review_row['file_chg']?>" alt="">
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="btn-promotion__wrap">
							<?php if($row['amount'] > 0 && isset($_SESSION[$_SESSION_DEFAULT_PREFIX . "id"]) && count(get_reservations($_SESSION[$_SESSION_DEFAULT_PREFIX . "id"])) === 0){ ?>
								<?php if($voucher_row['used_voucher'] == 1 || $voucher_row['voucher_state'] == 0){ ?>
									<a href="javascript:modalLayerOpen()" class="btn_reserv">点击预约</a>
								<?php }elseif($voucher_row['voucher_state'] == 1){ ?>
									<a href="./chk_go_promo.php?promotion_code=<?=$row['code']?>" class="btn_reserv">点击预约</a>
								<?php } ?>
							<?php } ?>
							<div class="scroll_top">
								<img src="../_img/common/btn_top.png" alt="">
							</div>
						</div>
					</section>
				</div>
			</div>
		</main>
		<!-- 바우처 없음 모달 시작 -->
		<div class="modal-layer" data-modal="not-result">
			<div class="modal-layer__window">
				<div class="modal-body">
					<div class="modal-center__content">
						<p>
							没有可以使用的抵用券
						</p>
					</div>
				</div>
				<div class="button__wrap">
					<button type="button" class="btn btn-radius btn-close">关闭</button>
				</div>
			</div>
		</div>
		<!-- 바우처 없음 모달 끝 -->
		<?php include("../_inc/menu.php"); ?>
	</div>
	<script>
        function modalLayerOpen(){
            document.querySelector('.modal-layer').classList.add('on')
        }
	</script>
</body>
</html>