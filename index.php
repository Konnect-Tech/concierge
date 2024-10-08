<?php

use PhpMyAdmin\Console;

include $_SERVER["DOCUMENT_ROOT"] . "/_inc/head.php";

$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];

if($member_idx) {
    $query = " SELECT * FROM member_info WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);
$row = $result->fetch_array();
}

?>

<body>
    <div id="wrap" class="index-page">
        <main class="main">
            <div class="index__container">
                <div class="index__top">
                    <h1><img src="/_img/common/logo-main.png" alt="Konnect Concierge"></h1>
                    <div class="lang-ch__wrap" style="z-index: 1;">
                        <button type="button" class="btn-lang">
                            <img src="/_img/common/icon_lang.svg" alt="">
                            KR
                        </button>
                        <div class="lang-ch__list">
                            <a href="/index.php" class="on">KR</a>
                            <a href="/cn/index.php">CN</a>
                        </div>
                    </div>
                </div>
                <section class="main-mypage">
                <div class="autoplay main-voucher-img" style="margin-bottom: 20px;"></div>
                <!-- <?php 
                    if($member_idx){
                        echo '<div style="width: 100%; height: 10px; flex-shrink: 0; background: #F3F6F6" ></div>';
                    }
                ?> -->
                    <div class="section__inner">
                        <!-- <h2 class="screen--out">내 정보</h2>
                        <div class="mypage-member">
                            <div class="profile__img <?php if($member_idx){ echo 'btn-modal'; } ?>" data-modal="profile">
								<img src="<?=$_P_DIR_WEB_FILE?>profile/<?=get_member_profile_img($member_idx)?>" alt="">
                            </div>
                            <div class="name__wrap">
								<?php if(!$member_idx){ ?>
									<p class="nickname"><a href="./login/login.php">로그인해주세요</a></p>
								<?php }else{ ?>
									<p class="nickname"><a href="/mypage/mypage_main.php"><?=$_SESSION[$_SESSION_DEFAULT_PREFIX . "name"]?></a></p>
									<p class="id-number"><a href="/mypage/mypage_main.php"><?=$_SESSION[$_SESSION_DEFAULT_PREFIX . "code"]?></a></p>
								<?php } ?>
                            </div>
                        </div>
                        <div class="mypage-point">
							<?php
							$d_total_point = 0;
							$m_total_point = 0;
							if($member_idx){
								$point_query = "
								SELECT
									COALESCE(SUM(CASE WHEN c.currency = 'D' THEN c.amount ELSE 0 END), 0) AS D_total,
									COALESCE(SUM(CASE WHEN c.currency = 'M' THEN c.amount ELSE 0 END), 0) AS M_total
								FROM member_info AS m
								LEFT JOIN currency_info AS c ON m.idx = c.member_idx
								WHERE m.idx = '$member_idx'
								GROUP BY m.idx
								";
								$point_result = mysqli_query($gconnet, $point_query);
								$point_row = $point_result->fetch_array();

								$d_total_point = $point_row['D_total'];
								$m_total_point = $point_row['M_total'];
							}
							?>
                            <div class="point__wrap">
                                <div class="point-item point-d">
                                    <p>포인트 <button type="button" class="btn-modal btn-info-view" data-modal="point-d">?</button></p> -->
                                    <!-- 해당되는 포인트 적립 리스트가 보이게 이동 -->
                                    <!-- <a href="/mypage/point_save.php" class="amount-num"><span><?=number_format($d_total_point)?></span>P</a>
                                </div>
                                <div class="point-item point-m">
                                    <p>포인트 <button type="button" class="btn-modal btn-info-view" data-modal="point-m">?</button></p> -->
                                    <!-- 해당되는 포인트 적립 리스트가 보이게 이동 -->
                                    <!-- <a href="/mypage/point_save.php" class="amount-num"><span><?=number_format($m_total_point)?></span>P</a>
                                </div>
                            </div>

							<?php
							$total_m = 0;
							$total_d = 0;
							if($member_idx){
								$total_currency_query = "
								SELECT
								    COALESCE(SUM(CASE WHEN b.type = 0 THEN c.amount ELSE 0 END), 0) AS M_total_amount,
								    COALESCE(SUM(CASE WHEN b.type = 1 THEN c.amount ELSE 0 END), 0) AS D_total_amount
								FROM buy_history_info b
								INNER JOIN currency_info c ON b.currency_idx = c.idx
								INNER JOIN member_info m ON c.member_idx = m.idx
								WHERE m.idx = '$member_idx'
								";
								$total_currency_result = mysqli_query($gconnet, $total_currency_query);
								$total_currency_row = $total_currency_result->fetch_array();

								$total_m = $total_currency_row['M_total_amount'];
								$total_d = $total_currency_row['D_total_amount'];
							}
							$total = $total_m + $total_d;

							?>
                            <div class="amount__wrap">
                                <div class="amount">
                                    <p>누적구매액 <button type="button" class="btn-modal btn-info-view" data-modal="amount">?</button></p>
                                    <a href="/mypage/amount_d.php" class="amount-num"><span><?=number_format($total)?></span>원</a>
                                </div>
                                <p class="amount__item">
                                    <span>면세</span>
                                    <a href="/mypage/amount_d.php" class="amount-num"><span><?=number_format($total_m)?></span>원</a>
                                </p>
                                <p class="amount__item">
                                    <span>메디컬</span>
                                    <a href="/mypage/amount_m.php" class="amount-num"><span><?=number_format($total_d)?></span>원</a>
                                </p>
                            </div>
                        </div>
						<?php if($member_idx){ ?>
							<?php
							$voucher_query = " SELECT voucher_state,used_voucher FROM member_info WHERE `idx` = '$member_idx' ";
							$voucher_result = mysqli_query($gconnet, $voucher_query);
							$voucher_row = $voucher_result->fetch_array();
							if($voucher_row['voucher_state'] == 1){
								$reservations = get_reservations($_SESSION[$_SESSION_DEFAULT_PREFIX . "id"]);
								?> -->
								<!-- 로그인 후 활동시 -->
								<!-- <div class="voucher__wrap">
									<a href="/mypage/reserve_medical.php">
										<span>메디컬바우처</span>
										<?php if(count($reservations) === 0){ ?>
											<span class="on">예약가능</span>
										<?php }else{
											$reserve = $reservations[0];
											if(isset($reserve['treated']) && $reserve['treated']){
												?>
												<span class="on">사용완료</span>
												<?php
											}else{
												?>
												<span class="off">사용대기중</span>
												<?php
											}
											?>

										<?php } ?>
									</a>
								</div>
							<?php } ?>
						<?php } ?>

						<?php if($member_idx){ ?>
                        
                        <div class="" style="margin-top:10px">
                                <span class="main__title">기프트코드등록</span><br/>
                                <div style="display:flex; justify-content:space-between; margin-top:8px;">
                                    <input id="coupon" class="common-input" style="width:30rem !important" name="email" placeholder="코드를 입력해주세요" >
                                    <button type="button" style="background-color:#207A80; color:white; padding:10px 15px; border-radius: 30px;" onclick="saveCoupon()">등록</button>
                                </div>
                        </div>

                        <?php } ?>
                      
                        

                        <div class="main-banner" style="margin-top:17px;">
                            <a href="../event/event.php">
                                <div class="banner__img">
                                    <img src="/_img/mypage/banner_img.png" alt="">
                                </div> 
                            </a>
                        </div>
                    </div> -->
                    <?php 
                        if($member_idx){
                            echo '<div class="code-controller"></div>';
                        }
                    ?>
                    <?php 
                        if(!$member_idx){
                            echo 
                            '<div><br><span style="font-size: 20px; font-weight:bold;">신라면세점 x 커넥트 바우처</span>
                            <button style="width: 100%; height: 48px; line-height: 40px; display: inline-block; background-color: #207A80; color: #fff; text-align: center; cursor: pointer; border-radius: 10px; margin-top:15px;" onclick="goJoinPage()" > 가입하고 혜택받기</button></div>';
                            // <button id="test" style="width: 50%; height: 48px; line-height: 48px; display: inline-block; background-color: #207A80; color: #fff;'+ 'text-align: center; cursor: pointer; border-radius: 10px;" type="button" onclick="saveVoucher()">바우처 받기</button>
                        }
                    ?>
                     <!-- <button type="button" style="background-color:#207A80; color:white; padding:10px 15px; border-radius: 30px;" onclick="saveCoupon()">등록</button> -->
                </section>
                <section class="main-benefit">
                    <div class="section__inner">
                        <h2 class="main__title">커넥트 컨시어지만의 혜택</h2>
                        <ul class="benefit__list">
                            <li class="btn-modal" data-modal="benefit">
                                <em class="benefit__title">혜택 1</em>
                                <div class="benefit__img" style="margin-bottom: 10px;">
                                    <img src="/_img/common/benefit_1.png?23434" alt="">
                                </div>
                                <span>메디컬 서비스<br>무료 이용권 제공<br><small>(성형외과/피부과)</small></span>
                            </li>
                            <li class="btn-modal" data-modal="benefit">
                                <em class="benefit__title">혜택 2</em>
                                <div class="benefit__img">
                                    <img src="/_img/common/benefit_2.png" alt="">
                                </div>
                                <span>구매 금액에 따른<br>추가 상품 제공</span>
                            </li>
                            <li class="btn-modal" data-modal="benefit">
                                <em class="benefit__title">혜택 3</em>
                                <div class="benefit__img">
                                    <img src="/_img/common/benefit_3.png" alt="">
                                </div>
                                <span>브랜드별 추가 리워드<br>COMING SOON</span>
                            </li>
                            <li>
                                <em class="benefit__title">혜택 4</em>
                                <div class="benefit__img">
                                    <img src="/_img/common/benefit_4.png?ㄴㅇㄴㅇㅇㄴ" alt="">
                                </div>
                                <span>KCT(Konnect)<br>리워드 제공</span>
                            </li>
                        </ul>
                    </div>
                </section>
                <section class="main-reserve">
                    <h2 class="main__title">메디컬 예약</h2>
                    <div class="reserve__wrap">
                        <a href="/promotion/list.php">
                            <p>커넥트 컨시어지<br>제휴 병원에서 혜택 받기</p>
                            <img src="./_img/common/reservation_img.png" alt="예약 이미지">
                        </a>
                    </div>
                </section>
            </div>
        </main>

        <!-- 포인트 modal -->
        <div class="modal-layer" data-modal="point-d">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div class="modal-info point">
                        <div class="img">
                            <img src="./_img/common/icon_d.png" alt="아이콘D">
                        </div>
                        <em>D 포인트란?</em>
                        <p>고객들께 드리는 커넥트 컨시어지만의 특별한 서비스로, 더 많이 구매하신 고객들께 더 많은 혜택을 돌려드립니다.</p>
                    </div>
                    <div class="modal-info__detail">
                        <p>[포인트 적립]</p>
                        <ul class="modal-info__list">
                            <li><span class="dot">&middot;</span><b>오프라인 면세</b>&nbsp;: 결제 금액의 1% 적립</li>
                        </ul>
                        <p>[포인트 사용]</p>
                        <ul class="modal-info__list">
                            <li><span class="dot">&middot;</span>커넥트 컨시어지 제휴처 : 메디컬, 호텔, 스파 등 현금처럼 사용 가능</li>
                            <li><span class="dot">&middot;</span>유효기간 : 없음</li>
                        </ul>
                        <p>*단, 특수브랜드 제외</p>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">닫기</button>
                </div>
            </div>
        </div>
        <div class="modal-layer" data-modal="point-m">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div class="modal-info point">
                        <div class="img">
                            <img src="./_img/common/icon_m.png" alt="아이콘D">
                        </div>
                        <em>M 포인트란?</em>
                        <p>고객들께 드리는 커넥트 컨시어지만의 특별한 서비스로, 더 많이 구매하신 고객들께 더 많은 혜택을 돌려드립니다.</p>
                    </div>
                    <div class="modal-info__detail">
                        <p>[포인트 적립]</p>
                        <ul class="modal-info__list">
                            <li><span class="dot">&middot;</span>오프라인 메디컬 : 결제 금액의 10~20% 적립 (바우처 및 포인트 사용 금액 제외)</li>
                        </ul>
                        <p>[포인트 사용]</p>
                        <ul class="modal-info__list">
                            <li><span class="dot">&middot;</span>포인트는 신라 면세점 선불카드로 교환</li>
                            <li><span class="dot">&middot;</span>1만 포인트부터 사용 가능</li>
                            <li><span class="dot">&middot;</span>선불카드 교환처 : 신라 면세점 내 커넥트 컨시어지 리셉션</li>
                            <li><span class="dot">&middot;</span>유효기간 : 없음</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">닫기</button>
                </div>
            </div>
        </div>
        <div class="modal-layer" data-modal="amount">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div class="modal-info purchase">
                        <em>누적구매액이란?</em>
                        <p>신라면세점과 커넥트 컨시어지 메디컬 제휴처에서 구매한 금액으로, 혜택 제공에 대한 기준이 됩니다.</p>
                    </div>
                    <div class="modal-info__detail">
                        <ul class="modal-info__list">
                            <li><span class="dot">&middot;</span><b>면세</b>&nbsp;: 프로모션 시작일로부터 온/오프라인에서 구매 금액 합산</li>
                            <li><span class="dot">&middot;</span><b>메디컬</b>&nbsp;: 제휴 병원 내 결제 금액 합산 (바우처 및 포인트  사용금액 제외) </li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">닫기</button>
                </div>
            </div>
        </div>

        <!-- 혜택 modal -->
        <div class="modal-layer" data-modal="benefit-1">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div class="modal-info">
                        <em>혜택 1.<br><span>메디컬 추천코드란?</span></em>
                        <p>커넥트 컨시어지의 제휴병원에서 고객님의 메디컬 추천 코드를 제시하여 서비스를 이용하는 경우, 서비스 이용 금액의 10~20%의 포인트를 받을 수 있는 고유코드 입니다.</p>
                    </div>
                    <div class="modal-info__detail">
                        <p>[메디컬 추천 코드 발급 조건]</p>
                        <ul class="modal-info__list">
                            <li>커넥트컨시어지 회원가입 고객</li>
                        </ul>
                        <p>[추천 코드 사용방법]</p>
                        <ul class="modal-info__list">
                            <li><span>1.</span>커넥트 컨시어지 제휴병원 예약 시 사용</li>
                            <li><span>2.</span>시스템 확인 후, 포인트 지급</li>
                            <li><span>3.</span>포인트는 신라면세점 내 커넥트컨시어지 리셉션에서 신라면세점 선불카드로 교환하여 사용</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">닫기</button>
                </div>
            </div>
        </div>
        <div class="modal-layer" data-modal="benefit-2">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div class="modal-info">
                        <em>혜택 2.<br><span>50만원 상당의 메디컬 바우처란?</span></em>
                        <p>커넥트 컨시어지 제휴 병원에서 진행하는 프로모션 시술을 이용할 수 있는 바우처입니다.</p>
                    </div>
                    <div class="modal-info__detail">
                        <p>[바우처 지급 조건]</p>
                        <ul class="modal-info__list">
                            <li>프로모션 기간일로부터 신라면세점 누적구매금액이 400만원 이상인 고객</li>
                        </ul>
                        <p>[바우처 사용방법]</p>
                        <ul class="modal-info__list">
                            <li><span>1.</span>메디컬 페이지 내 프로모션 예약하기 (바우처가 발급되면 예약이 가능합니다)</li>
                            <li><span>2.</span>예약 후, CS담당자가 연락</li>
                            <li><span>3.</span>픽업 선택 시, 픽업지에서 대기</li>
                            <li><span>4.</span>가이드와 병원 방문하기</li>
                            <li><span>5.</span>병원 담당자에게 바우처 보여주기 바우처는 ‘마이페이지 > 메디컬 예약 내역'에서 확인이 가능합니다.</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">닫기</button>
                </div>
            </div>
        </div>
        <div class="modal-layer" data-modal="benefit-3">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div class="modal-info">
                        <em>혜택 3.<br><span>브랜드 구매란?</span></em>
                        <p>커넥트 컨시어지와 제휴된 뷰티, 패션, 헬스, 메디컬 제품을 좋은 가격으로 구매할 수 있는 권한입니다.</p>
                    </div>
                    <div class="modal-info__detail">
                        <p>[권한 부여 조건]</p>
                        <ul class="modal-info__list">
                            <li>프로모션 기간일로부터 회원가입 모든 고객 대상</li>
                        </ul>
                        <p>[제품 구매방법]</p>
                        <ul class="modal-info__list">
                            <li>브랜드 페이지에서 제품 골라 구매 문의하기 클릭 후 구매진행</li>
                            <li><span class="color--primary">*</span> 플랫폼 상담사와 위챗에서 상담하기</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">닫기</button>
                </div>
            </div>
        </div>
        <div id="voucher_save" class="modal-layer" data-modal="voucher">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div style="text-align: center;">
                    <?php if($voucher_img){
                        echo '<img src="/_img/common/benefit_1.png">';
                    } else if($voucher_img) {    
                        echo '<img src="/_img/common/benefit_1.png">';
                    } else {
                        echo '<img src="/_img/common/benefit_1.png">';
                    }  ?>
                    </div>
                    <?php if($voucher_num == 1){
                        echo '<div class="modal-info__detail" style="text-align: center;"><p style="color:#207A80;">$1,000이상 구매고객용 바우처</p>';  
                    } else{
                        echo '<div class="modal-info__detail" style="text-align: center;"><p style="color:#207A80;">$3,000이상 구매고객용 바우처</p>';
                    } ?>
                        <p>해당 바우처를 받으시겠어요?</p>
                        <p>이미지</p>
                    </div>
                    <div class="modal-info__detail">
                        <ul class="modal-info__list">
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>바우처 받기는 이벤트 기간내 1회만 가능합니다 (~24.04.04)</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>더 높은 금액의 바우처를 받으려면 필요 누적 구매 금액을 달성 후 코드를 다시 입력하세요</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>받은 바우처는 변경 및 취소가 되지 않습니다</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>바우처는<b>'마이페이지> 나의 바우처'</b>에서 확인하 실 수 있어요</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">받기</button>
                </div>
            </div>
        </div>

        <!-- 위챗 modal -->
        <div class="modal-layer" data-modal="benefit-4">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div class="modal-info">
                        <em class="main__title" style="text-align: center;">고객센터 안내</em>
                    </div>
                    <div class="modal-info__detail">
                        <p>고객센터 이메일</p>
                        <ul class="modal-info__list">
                            <li>konnect-cs@konnect.finance</li>
                        </ul>
                        <p>고객센터 위챗</p>
                        <ul class="modal-info__list">
                            <li><span>위챗 ID :</span>konnect8</li>
                            <li><span>위챗QR코드</span></li>
                            <li><img src="/_img/common/qr_wechat.png" alt=""></li>
                        </ul>
                        <p>고객센터 업무 시간</p>
                        <ul class="modal-info__list">
                            <li><span>월~토 :</span>09:00 - 18:00</li>
                            <li><span>점심시간 :</span>09:00 - 18:00</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">닫기</button>
                </div>
            </div>
        </div>

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

        <?php include("./_inc/menu.php"); ?>
    </div>

	<form name="reset_profile_frm" method="post" action="/mypage/reset_profile_action.php" target="_fra_admin">
		<input type="hidden" name="member_idx" value="<?=$member_idx?>">
	</form>

    <script>

        $(".btn-lang").on("click",function(){
            if($(this).hasClass("on")){
                $(this).removeClass("on");
                $(".lang-ch__list").removeClass("on");
            }else{
                $(this).addClass("on");
                $(".lang-ch__list").addClass("on");
            }
        });

        $(document).on("mouseup", function (e) {
			if ($(".lang-ch__wrap").has(e.target).length == 0) {
				$(".btn-lang").removeClass("on");
				$(".lang-ch__list").removeClass("on");
			}
        });
    </script>
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

function saveCoupon(){

    var request = $.ajax({
        type: 'POST',
        data: {externalId:"<?=$row['shilla_id']?>",passportNum:"<?=$row['passport_num']?>",name:"<?=$row['passport_last_name']?>"+ "<?=$row['passport_first_name']?>",memberId:'<?=$member_idx?>',voucher:document.getElementById("coupon").value},
        url: 'https://concierge.fourdpocket.com/api/v1/voucherin/come',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        dataType: "json",
        success:function(result){
            console.log('ret : ' + result);
            alert("정상적으로 등록되었습니다.")
        }
    });

    var request = $.ajax({
        type: 'POST',
        data: {externalId:"<?=$row['shilla_id']?>",passportNum:"<?=$row['passport_num']?>",name:"<?=$row['passport_last_name']?>"+ "<?=$row['passport_first_name']?>",memberId:'<?=$member_idx?>',voucher:document.getElementById("coupon").value},
        url: 'https://concierge.fourdpocket.com/api/v1/voucherin/come',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        dataType: "json",
        success:function(result){
            console.log('ret : ' + result);
            alert("정상적으로 등록되었습니다.")
        }
    });

    }
</script>

<script type="text/javascript">
    function saveVoucher() {
        let code = document.getElementById("codeSave").value

        if(code.length == 0){
                alert("코드를 입력해주세요.")
                return ;
            }

        var request = $.ajax({
        type: 'POST',
        data: {code: code,conciergeId:"<?=$member_idx?>"},
        url: 'https://concierge.fourdpocket.com/api/v1/member/saveUniqueCode',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        dataType: "json",
        success:function(result){
            if(result.message == "등록되지않은 바우처입니다.") {
                alert(result.message);
                return ;
            }else if(result.code == 10001){
                alert(result.message)
                return ;
            }else if(result.codeName == "DUPLICATED_UNIQUE_CODE"){
                alert(result.message);
                return ;
            }else{
                alert("정상적으로 등록 되었습니다.")
            }


            window.location.href = "/extra/extra_voucher_progress.php";
        }
    });
    }

    function goJoinPage() {
        window.location.href = "/join/join_1.php";
    }

    function checkCode() {
        window.open('https://m.shilladfs.com/estore/kr/zh/event/eventView?eventId=E71362','','');
    //     let code = document.getElementById("codeSave").value
    //     console.log(code)

    //     var request = $.ajax({
    //     type: 'POST',
    //     data: {memberId:"<?=$member_idx?>"},
    //     url: 'https://concierge.fourdpocket.com/api/v1/voucherin/list',
    //     contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    //     dataType: "json",
    //     success:function(result){
    //         console.log(result,"데이타입니다`````````````````````````````")

    //         if(code.length == 0){
    //             alert("코드를 입력해주세요.")
    //             return ;
    //         }
    //         if(result.data.length == 0){
    //             alert("사용이 불가한 코드입니다.")
    //             return ;
    //         }

    //         for(let i=0;i<result.data.length;i++){
    //             if(code == result.data[i].voucher){
    //                 alert("이미 등록 된 코드입니다.")
    //                 return ;
    //             }else{
    //                 alert("등록 가능한 코드입니다.")
    //                 break ;
    //             }
    //         }
    //         console.log('ret : ' + result.data);
    //         alert("정상적으로 등록되었습니다.")
    //     }
    // });
    }

    
    function voucherProgress(){
        window.location.href = "/extra/extra_voucher_progress.php";
    }

</script>
<script>
     window.onload = function(){
        $.ajax({
            type: "GET",
            url: "https://concierge.fourdpocket.com/api/v1/banner/list/MAIN",
            success: function (res) {

                // let imgList= res.data.length; 
                let imgList = 3;

                console.log(res)
                console.log(res.data[0].thumnail)

                for(let i=0;i<imgList;i++){
                    let html = "";
                    let img = res.data[i].thumnail
                    $('.main-voucher-img').append(
                        "<img style='width: 100%; height: 600px;' src="+img+">"
                    )
                }

                $(document).ready(function(){
                    $('.autoplay').slick({
                        dots: true,
                        focusOnSelect: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 2000,
                    });
                });
            }
        });

};
</script>

<script>
    window.addEventListener('load', function(){
        $.ajax({
            type: "GET",
            url: "https://concierge.fourdpocket.com/api/v1/member/findByConciergeId/<?=$member_idx?>",
            success: function (res) {
                console.log(<?=$member_idx?>)
                let html = "";

                if(res.uniqueCode == null){
                    $('.code-controller').append(
                        '<div><br><span style="font-size: 20px; font-weight:bold;">신라면세점 x 커넥트 바우처 받기</span></div>'+
                        '<br><br><br><div style="text-align: center; padding-top: 0px">'+
                        '<input class="common-input" id="codeSave" type="textara" placeholder="코드를 입력하고 바우처를 받으세요"></div>'+
                        '<br><div style="text-align:center;  display: flex; align-items: center;gap: 16PX;  flex: 1;">'+
                        '<button style="width: 50%; height: 48px; line-height: 48px; display: inline-block; background-color: #F3F6F6;color: #89ABAD;'+ 'text-align: center; cursor: pointer; border-radius: 10px;"  type="button"  onclick="checkCode()">코드받기</button>'+
                        '<button id="test" style="width: 50%; height: 48px; line-height: 48px; display: inline-block; background-color: #207A80; color: #fff;'+ 'text-align: center; cursor: pointer; border-radius: 10px;" type="button" onclick="saveVoucher()">바우처 받기</button>'+
                        '</div>'
                    );
                    
                }else{
                    $('.code-controller').append(
                        '<div><br><span style="font-size: 20px; font-weight:bold;">신라면세점 x 커넥트 바우처 받기</span></div>'+
                        ' <br><br><div class="button__wrap">'+
                        '<button type="button" class="btn btn-radius" onclick="voucherProgress()">바우처 확인하기</button>'+
                        '</div>'
                    );
                }
            }
        });
    });
</script>

</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>