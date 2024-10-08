<?php
include("./_inc/head.php");

$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];

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
                            CN
                        </button>
                        <div class="lang-ch__list">
                            <a href="/index.php">KR</a>
                            <a href="/cn/index.php"  class="on">CN</a>
                        </div>
                    </div>
                </div>
                <section class="main-mypage">
                <div class="autoplay main-voucher-img" style="margin-bottom: 20px;"></div>
                    <div class="section__inner">
                    <?php 
                        if($member_idx){
                            echo '<div class="code-controller"></div>';
                        }
                    ?>
                        <div class="mypage-member">
							<!-- <div class="profile__img <?php if($member_idx){ echo 'btn-modal'; } ?>" data-modal="profile">
								<img src="<?=$_P_DIR_WEB_FILE?>profile/<?=get_member_profile_img($member_idx)?>" alt="">
                            </div> -->
                            <!-- <div class="name__wrap">
								<?php if(!$member_idx){ ?>
									<p class="nickname"><a href="./login/login.php">请登录</a></p>
								<?php }else{ ?>
									<p class="nickname"><a href="./mypage/mypage_main.php"><?=$_SESSION[$_SESSION_DEFAULT_PREFIX . "name"]?></a></p>
									<p class="id-number"><a href="./mypage/mypage_main.php"><?=$_SESSION[$_SESSION_DEFAULT_PREFIX . "code"]?></a></p>
								<?php } ?>
                            </div>
                        </div> -->
                        <!-- <div class="mypage-point">
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
                                    <p>D 积分 <button type="button" class="btn-modal btn-info-view" data-modal="point-d">?</button></p>
                                     해당되는 포인트 적립 리스트가 보이게 이동 
                                    <a href="./mypage/point_save.php" class="amount-num"><span><?=number_format($d_total_point)?></span>P</a>
                                </div>
                                <div class="point-item point-m">
                                    <p>M 积分 <button type="button" class="btn-modal btn-info-view" data-modal="point-m">?</button></p>
                                    해당되는 포인트 적립 리스트가 보이게 이동
                                    <a href="./mypage/point_save.php" class="amount-num"><span><?=number_format($m_total_point)?></span>P</a>
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
                                    <p>累计购买金额 <button type="button" class="btn-modal btn-info-view" data-modal="amount">?</button></p>
                                    <a href="./mypage/amount_d.php" class="amount-num"><span><?=number_format($total)?></span>韩币</a>
                                </div>
                                <p class="amount__item">
                                    <span>免税</span>
                                    <a href="./mypage/amount_d.php" class="amount-num"><span><?=number_format($total_m)?></span>韩币</a>
                                </p>
                                <p class="amount__item">
                                    <span>医疗</span>
                                    <a href="./mypage/amount_m.php" class="amount-num"><span><?=number_format($total_d)?></span>韩币</a>
                                </p>
                            </div>
                        </div> -->

						<!-- <?php if($member_idx){ ?>
							<?php
							$voucher_query = " SELECT voucher_state,used_voucher FROM member_info WHERE `idx` = '$member_idx' ";
							$voucher_result = mysqli_query($gconnet, $voucher_query);
							$voucher_row = $voucher_result->fetch_array();
							if($voucher_row['voucher_state'] == 1){
								$reservations = get_reservations($_SESSION[$_SESSION_DEFAULT_PREFIX . "id"]);
								?>
								 로그인 후 활동시 
								<div class="voucher__wrap">
									<a href="./mypage/reserve_medical.php">
										<span>医疗抵用券</span>
										<?php if(count($reservations) === 0){ ?>
											<span class="on">可以预约</span>
										<?php }else{
											$reserve = $reservations[0];
											if(isset($reserve['treated']) && $reserve['treated']){
												?>
												<span class="on">使用完毕</span>
												<?php
											}else{
												?>
												<span class="off">等待使用中</span>
												<?php
											}
											?>

										<?php } ?>
									</a>
								</div>
							<?php } ?>
						<?php } ?> -->

                        <?php 
                            if(!$member_idx){
                                echo 
                                '<div><br><span style="font-size: 20px; font-weight:bold;">领取新罗免税店 X Konnect 消费券</span>
                                <button style="width: 100%; height: 48px; line-height: 40px; display: inline-block; background-color: #207A80; color: #fff; text-align: center; cursor: pointer; border-radius: 10px; margin-top:15px;" onclick="goJoinPage()" > 立即加入</button></div>';
                                // <button id="test" style="width: 50%; height: 48px; line-height: 48px; display: inline-block; background-color: #207A80; color: #fff;'+ 'text-align: center; cursor: pointer; border-radius: 10px;" type="button" onclick="saveVoucher()">바우처 받기</button>
                            }
                        ?>


                        <!-- <?php if($member_idx){ ?>
                        
                        <div class="" style="margin-top:10px">
                                <span class="main__title">礼品券代码注册</span><br/>
                                <div style="display:flex; justify-content:space-between; margin-top:8px;">
                                    <input id="coupon" class="common-input" style="width:30rem !important" name="email" placeholder="请输入代码" >
                                    <button type="button" style="background-color:#207A80; color:white; padding:10px 15px; border-radius: 30px;" onclick="saveCoupon()">注册</button>
                                </div>
                        </div> -->

                        <!-- <?php } ?> -->

                        <!-- <div class="main-banner" style="margin-top:17px;">
                            <a href="/cn/event/event.php">
                                <div class="banner__img">
                                    <img src="/cn/_img/mypage/banner_img.png" alt="">
                                </div> 
                            </a>
                        </div>
                    </div> -->
                   
                 
                </section>
                <section class="main-benefit">
                    <div class="section__inner">
                        <h2 class="main__title">专属Konnect Concierge的优惠</h2>
                        <ul class="benefit__list">
                            <li class="btn-modal" data-modal="">
                                <em class="benefit__title">优惠 1</em>
                                <div class="benefit__img">
                                    <img src="/_img/common/benefit_1.png?32434" alt="">
                                </div>
                                <span>提供免费医疗服务消费券<br><small>（整形外科／皮肤科）</small></span>
                            </li>
                            <li class="btn-modal" data-modal="">
                                <em class="benefit__title">优惠 2</em>
                                <div class="benefit__img">
                                    <img src="/_img/common/benefit_2.png" alt="">
                                </div>
                                <span>根据购买金额等级<br/>提供额外护肤礼包</span>
                            </li>
                            <li class="btn-modal" data-modal="">
                                <em class="benefit__title">优惠 3</em>
                                <div class="benefit__img">
                                    <img src="/_img/common/benefit_3.png" alt="">
                                </div>
                                <span>各品牌额外奖励</span>
                            </li>
                            <li>
                                <em class="benefit__title">优惠 4</em>
                                <div class="benefit__img">
                                    <img src="/_img/common/benefit_4.png?324234" alt="">
                                </div>
                                <span>KCT(Konnect)额外奖励</span>
                            </li>
                        </ul>
                    </div>
                </section>
                <section class="main-reserve">
                    <h2 class="main__title">预约医疗</h2>
                    <div class="reserve__wrap">
                        <a href="./promotion/list.php">
                            <p>与Konnect Concierge<br>合作的医院 享受特别的优惠吧</p>
                            <img src="./_img/common/reservation_img.png" alt="">
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
                            <img src="./_img/common/icon_d.png" alt="">
                        </div>
                        <em>D 积分是指?</em>
                        <p>仅限为顾客提供的Konnect Concierge的特别服务, 可为购买更多的客户提供更多的优惠</p>
                    </div>
                    <div class="modal-info__detail">
                        <p>[关于积分]</p>
                        <ul class="modal-info__list">
                            <li><span class="dot">&middot;</span><b>线下免税</b>&nbsp;: 最多可累积结算金额的1%</li>
                        </ul>
                        <p>[积分使用]</p>
                        <ul class="modal-info__list">
                            <li><span class="dot">&middot;</span>合作公司：医疗，酒店，SPA等可以像现金一样使用</li>
                            <li><span class="dot">&middot;</span>有效期 : 无</li>
                        </ul>
                        <p>*但，特殊品牌除外</p>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">关闭</button>
                </div>
            </div>
        </div>
        <div class="modal-layer" data-modal="point-m">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div class="modal-info point">
                        <div class="img">
                            <img src="./_img/common/icon_m.png" alt="">
                        </div>
                        <em>M 积分是指?</em>
                        <p>仅限为顾客提供的Konnect Concierge的特别服务, 可为购买更多的客户提供更多的优惠</p>
                    </div>
                    <div class="modal-info__detail">
                        <p>[关于积分]</p>
                        <ul class="modal-info__list">
                            <li><span class="dot">&middot;</span>现在免税 : 可累积结算金额的10~20% (抵用券及使用积分的金额除外)</li>
                        </ul>
                        <p>[积分使用]</p>
                        <ul class="modal-info__list">
                            <li><span class="dot">&middot;</span>积分可兑换成新罗免税店的预付卡</li>
                            <li><span class="dot">&middot;</span>从1万积分开始可以使用</li>
                            <li><span class="dot">&middot;</span>预付卡交换处 : 新罗免税店内的Konnect Concierge接待处</li>
                            <li><span class="dot">&middot;</span>有效期 : 无</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">关闭</button>
                </div>
            </div>
        </div>
        <div class="modal-layer" data-modal="amount">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div class="modal-info purchase">
                        <em>累计购买金额是指？</em>
                        <p>根据在新罗免税店和Konnect Concierge医疗合作公司购买的金额，是提供优惠的标准</p>
                    </div>
                    <div class="modal-info__detail">
                        <ul class="modal-info__list">
                            <li><span class="dot">&middot;</span><b>免税</b>&nbsp;: 从促销活动开始起，线上/线下购买的金额合计</li>
                            <li><span class="dot">&middot;</span><b>医疗</b>&nbsp;: 合作医院内结算金额合计（抵用券及使用积分的金额除外）</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">关闭</button>
                </div>
            </div>
        </div>

        <!-- 혜택 modal -->
        <div class="modal-layer" data-modal="benefit-1">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div class="modal-info">
                        <em>优惠 1.<br><span>医疗推荐代码是指?</span></em>
                        <p>在Konnect Concierge的合作医院，出示客户的医疗推荐代码后使用该服务的话，是可获得服务使用金额的10~20%积分的固有代码</p>
                    </div>
                    <div class="modal-info__detail">
                        <p>[医疗推荐代码发放条件]</p>
                        <ul class="modal-info__list">
                            <li>Konnect Concierge会员</li>
                        </ul>
                        <p>[推荐代码使用方法]</p>
                        <ul class="modal-info__list">
                            <li><span>1.</span>预约与Konnect Concierge合作的医院时，即可使用</li>
                            <li><span>2.</span>确认系统后， 提供积分</li>
                            <li><span>3.</span>积分可在新罗免税店内的Konnect Concierge接待处，用新罗免税店预付卡交换使用</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">关闭</button>
                </div>
            </div>
        </div>
        <div class="modal-layer" data-modal="benefit-2">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div class="modal-info">
                        <em>优惠 2.<br><span>相当于50万韩币的医疗抵用券是指?</span></em>
                        <p>这是可以在Konnect Concierge合作的医院进行的促销中的施术项目上使用的抵用券</p>
                    </div>
                    <div class="modal-info__detail">
                        <p>[抵用券发放条件]</p>
                        <ul class="modal-info__list">
                            <li>在促销期间，新罗免税店累计购买金额超过400万韩币以上的客户</li>
                        </ul>
                        <p>[抵用券使用方法]</p>
                        <ul class="modal-info__list">
                            <li><span>1.</span>预约医疗页面内的促销活动 (发放抵用券之后，即可预约)</li>
                            <li><span>2.</span>预约后，CS负责人会联系客户</li>
                            <li><span>3.</span>选择接送时，请在接送站等待</li>
                            <li><span>4.</span>与导游一起去访问医院</li>
                            <li><span>5.</span>向医院负责人出示抵用券 抵用券可以在"我的主页>医疗预约明细" 中确认</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">关闭</button>
                </div>
            </div>
        </div>
        <div class="modal-layer" data-modal="benefit-3">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div class="modal-info">
                        <em>优惠 3.<br><span>品牌购买是指? </span></em>
                        <p>以最满意的价格，可够买与Konnect Concierge合作的美妆，时尚，健身，医疗产品的权限</p>
                    </div>
                    <div class="modal-info__detail">
                        <p>[授权条件]</p>
                        <ul class="modal-info__list">
                            <li>在促销期间，注册会员的所有客户为对象</li>
                        </ul>
                        <p>[产品购买方法]</p>
                        <ul class="modal-info__list">
                            <li>在品牌页面选择产品之后，点击购买咨询后进行购买</li>
                            <li><span class="color--primary">*</span> 与平台客服，通过微信商谈</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">关闭</button>
                </div>
            </div>
        </div>

        <!-- 위챗 modal -->
        <div class="modal-layer" data-modal="benefit-4">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div class="modal-info">
                        <em class="main__title" style="text-align: center;">客服中心介绍</em>
                    </div>
                    <div class="modal-info__detail">
                        <p>客服电子邮件</p>
                        <ul class="modal-info__list">
                            <li>konnect-cs@konnect.finance</li>
                        </ul>
                        <p>客服微信</p>
                        <ul class="modal-info__list">
                            <li><span>微信 ID :</span>konnect8</li>
                            <li><span>微信二维码</span></li>
                            <li><img src="/_img/common/qr_wechat.png" alt=""></li>
                        </ul>
                        <p>客服工作时间</p>
                        <ul class="modal-info__list">
                            <li><span>周一 ~ 周六 :</span>09:00 - 18:00</li>
                            <li><span>中午时间 :</span>09:00 - 18:00</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close">关闭</button>
                </div>
            </div>
        </div>



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

        <?php include("./_inc/menu.php"); ?>
    </div>

	<form name="reset_profile_frm" method="post" action="./mypage/reset_profile_action.php" target="_fra_admin">
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
                            alert("您已成功更改您的个人资料图片。")
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
    
function goJoinPage() {
    window.location.href = "join/join_1.php";
}

function saveCoupon(){

    var request = $.ajax({
        type: 'POST',
        data: {externalId:"<?=$row['shilla_id']?>",passportNum:"<?=$row['passport_num']?>",name:"<?=$row['passport_last_name']?>"+ "<?=$row['passport_first_name']?>",memberId:'<?=$member_idx?>',voucher:document.getElementById("coupon").value},
        url: 'https://concierge.fourdpocket.com/api/v1/voucherin/come',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        dataType: "json",
        success:function(result){
            console.log('ret : ' + result);
            alert("完全的")
        }
    });

    }
</script>

<script type="text/javascript">
    function saveVoucher() {
        let code = document.getElementById("codeSave").value

        if(code.length == 0){
                alert("输入代码后领取消费券")
                return ;
            }

        var request = $.ajax({
        type: 'POST',
        data: {code: code,conciergeId:"<?=$member_idx?>"},
        url: 'https://concierge.fourdpocket.com/api/v1/member/saveUniqueCode',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        dataType: "json",
        success:function(result){
            console.log('ret : ' + result);
            if(result.message == "消费券不存在") {
                alert(result.message);
                return ;
            }else if(result.code == 10001) {
                alert(result.message);
                return ;
            }else if(result.codeName == "DUPLICATED_UNIQUE_CODE"){
                alert("消费券使用完毕。");
                return ;
            }else{
                alert("登记完成")
            }

            window.location.href = "/cn/extra/extra_voucher_progress.php";
        }
    });
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
        window.location.href = "/cn/extra/extra_voucher_progress.php";
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

                console.log(res,"1111111111111111111111111")
                console.log(res.data[0].thumnail)

                for(let i=0;i<imgList;i++){
                    let html = "";
                    let img = res.data[i].thumbnailCn
                    console.log(res.data[i].thumbnailCn,"11111111111111111111111")
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
                console.log(res,"ddddddddddddddddddddd")
                console.log(<?=$member_idx?>)
                let html = "";

                if(res.uniqueCode == null){
                    $('.code-controller').append(
                        '<div><br><span style="font-size: 18px; font-weight:bold;">领取新罗免税店 X Konnect 消费券</span></div>'+
                        '<br><br><br><div style="text-align: center; padding-top: 0px">'+
                        '<input class="common-input" id="codeSave" type="textara" placeholder="输入代码后领取消费券"></div>'+
                        '<br><div style="text-align:center;  display: flex; align-items: center;gap: 16PX;  flex: 1;">'+
                        '<button style="width: 50%; height: 48px; line-height: 48px; display: inline-block; background-color: #F3F6F6;color: #89ABAD;'+ 'text-align: center; cursor: pointer; border-radius: 10px;"  type="button"  onclick="checkCode()">获取代码</button>'+
                        '<button id="test" style="width: 50%; height: 48px; line-height: 48px; display: inline-block; background-color: #207A80; color: #fff;'+ 'text-align: center; cursor: pointer; border-radius: 10px;" type="button" onclick="saveVoucher()">确认消费券</button>'+
                        '</div>'
                    );
                    // console.log(document.getElementById('test').style.backgroundColor)
                }else{
                    $('.code-controller').append(
                        '<div><br><span style="font-size: 18px; font-weight:bold;">领取新罗免税店 X Konnect 消费券</span></div>'+
                        ' <br><br><div class="button__wrap">'+
                        '<button type="button" class="btn btn-radius" onclick="voucherProgress()">领取消费券</button>'+
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