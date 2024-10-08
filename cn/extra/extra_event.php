<?php include("../_inc/head.php"); 
	$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
?>
<body>
	<div id="wrap">
		<header id="header">
			<div class="header__inner">
				<button type="button" class="btn_back"></button>
			</div>
			<div class="header__title">活动</div>
		</header>
		<main class="main">
			<div id="container" class="event_container">
				<div class="event__inner">
					<div class="event_first">
						<div class="event_first__inner">
						</div>
					</div>
					<div class="event_etc">
						<div><br><span id="text" style="font-size: 18px; font-weight:bold;"></span></div>
						<br><br>
						<div class="code-controller"></div>
						<div><br><span style="font-size: 20px; font-weight:bold;">活动优惠</span></div>
						<div class="join_benefits">
							<div class="benefits_list">
								<div class="benefit">
									<div class="right_img">
										<img src="../_img/event_item01.png?123" alt="이벤트 이미지">
									</div>
								</div>
								<div class="benefit">
									<div class="right_img">
										<img src="../_img/event_item02.png?213" alt="이벤트 이미지">
									</div>
								</div>
								<div class="benefit">
									<div class="right_img">
										<img src="../_img/event_item03.png?123" alt="이벤트 이미지">
									</div>
								</div>
								<div class="benefit">
									<div class="right_img">
										<img src="../_img/event_item04.png" alt="이벤트 이미지">
									</div>
								</div>
							</div>
						</div>
						<div class="event_info">
							<div class="event_info-item">
								<br>
								<div style="text-align: center; padding-bottom:10px;"><img src="/_img/Vector.svg" alt=""></div>
								<h3>申请活动前，请务必确认！</h3>
								<ul>
									<li>该消费券 <b>'活动期间只能申请一”次'</b></li>
									<li>如要获得更高金额的消费券，请在达到所需累计金额后进行领取。</li>
									<li>只适用于确认出境的人，申请加入时，请准确输入护照信息。</li>
									<li>累计购买金额出境后７～１０天生效。（工作日基准）</li>
									<li>已签发的消费券不可更改或取消。</li>
									<li>消费券 “在 我的页面>我的消费券”里查看。</li>
								</ul>
							</div>
							<div class="event_info-item">
								<h3>- 注意事项 -</h3>
								<ul>
									<li>该活动是与新罗免税店的合作项目。</li>
									<li>该活动仅适于自活动之日起加入Konnect 贵宾室的顾客。</li>
									<li>礼品交换处位于新罗免税店首尔店１楼服务台。</li>
									<li>提供一次医疗消费券，可联系合作医院预约进行。</li>
									<li>如因顾客操作（注销会员 等）导致无法领取消费券时，将无法补发。</li>
									<li>身份盗用，重复加入等方式参加活动时，将不予签发消费券。</li>
									<li>根据本公司情况，可能会在无事先通知的情况下更改活动内容或提前结束活动。</li>
									<li>如有疑问，请联系客服中心－微信账号 konnect8。</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>
</body>

<script>
    window.addEventListener('load', function(){
        $.ajax({
            type: "GET",
            url: "https://concierge.fourdpocket.com/api/v1/member/findByConciergeId/<?=$member_idx?>",
            success: function (res) {
                console.log(res)
                let html = "";

				if(res.message == "사용자를 찾을 수 없습니다."){
					return ;
				}

                if(res.uniqueCode == null){
					document.getElementById('text').innerText = "领取新罗免税店 X Konnect 消费券";
                    $('.code-controller').append(
                        '<br><div style="text-align: center; padding-top: 0px">'+
                        '<input class="common-input" id="codeSave" type="textara" placeholder="输入代码后领取消费券"></div>'+
                        '<br><div style="text-align:center;  display: flex; align-items: center;gap: 16PX;  flex: 1;">'+
                        '<button style="width: 50%; height: 48px; line-height: 48px; display: inline-block; background-color: #F3F6F6;color: #89ABAD;'+ 'text-align: center; cursor: pointer; border-radius: 10px;"  type="button"  onclick="checkCode()">获取代码</button>'+
                        '<button id="test" style="width: 50%; height: 48px; line-height: 48px; display: inline-block; background-color: #207A80; color: #fff;'+ 'text-align: center; cursor: pointer; border-radius: 10px;" type="button" onclick="saveVoucher()">领取消费券</button>'+
                        '</div>'
                    );
                    console.log(document.getElementById('test').style.backgroundColor)
                }else{
					document.getElementById('text').innerText = "领取新罗免税店 X Konnect 消费券";
                    $('.code-controller').append(
                        ' <div class="button__wrap">'+
                         '<button type="button" class="btn btn-radius" style="color: #fff; background-color: #207A80;" onclick="voucherProgress()">确认消费券</button>'+
                         '</div>'
                    );
                }
            }
        });
    });
</script>

<script>
	function voucherProgress(){
		window.location.href = "/cn/extra/extra_voucher_progress.php"
	}
</script>

<script>
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
    }
</script>

</html>