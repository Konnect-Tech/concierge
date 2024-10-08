<?php include("../_inc/head.php"); 
    $member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
?>
<body>
	<div id="wrap">
		<header id="header">
			<div class="header__inner">
				<button type="button" class="btn_back"></button>
			</div>
			<!-- <div class="header__title">이벤트</div> -->
		</header>
		<main class="main">
			<div id="container" class="event_container">
				<div class="event__inner">
					<div class="event_first">
						<div class="event_first__inner">
						</div>
					</div>
                    <section class="main-mypage">
                    <div class="section__inner">
                        <h2 class="screen--out">내 정보</h2>
                            <div class="mypage-member">
                                <div class="profile__img btn-modal" data-modal="profile">
									<img src="<?=$_P_DIR_WEB_FILE?>profile/<?=get_member_profile_img($member_idx)?>" alt="">
                                </div>
                                    <div class="name__wrap codeAdd"></div>
                            </div>
                    </div>
                </section>
                    <div class="voucher-progress" style="text-align: center; padding-top:10px;"></div>
					<div id="balance-controller" class="balance-controller" style="width: 90%; margin: 10px auto; display: flex; text-align: center; padding-bottom:30px;">
                        <div style="flex:1; width:30%; box-sizing: border-box; padding-top:0px;">
                            <button id="test12" style="padding: 5px; margin:10px; border-radius: 16px; color:#89ABAD ; background: #F3F6F6;" onclick="voucherSaver1()">领取</button>
                        </div>
                        <div style="flex:1; width:30%; box-sizing: border-box; padding-top:0px;">
                            <button id="test13" style="padding-top:0px; padding: 5px; margin-top:10px; border-radius: 16px; color:#89ABAD ; background: #F3F6F6;" onclick="voucherSaver2()">领取</button>
                        </div>
                        <div style="flex:1; width:30%; box-sizing: border-box; padding-top:0px;">
                            <button id="test14" style="padding-top:0px; padding: 5px; margin-top:10px; border-radius: 16px; color:#89ABAD ; background: #F3F6F6;" onclick="voucherSaver3()">领取</button>
                        </div>
                    </div>
					<div class="event_etc">
						<br><br>
						<div style="text-align: center;"><br><span style="font-size: 20px; font-weight:bold;">达到累计购买金额，可领取一个礼品。</span></div>
						<div class="join_benefits">
							<div class="benefits_list">
								<div id="item01" class="benefit">
									<div class="right_img">
										<div id="img1" style="float:right; color: #fff; background-color: #D9D9D9; border-radius: 16px; padding-top:7px; padding-bottom:7px; padding-left:10px; padding-right:10px;">未达到</div>
										<img class="btn-modal" data-modal="voucher" src="../_img/event_progress01.png" alt="이벤트 이미지">
									</div>
								</div>
								<div id="item02" class="benefit">
									<div class="right_img">
                                    <div id="img2" style="float:right; color: #fff; background-color: #D9D9D9; border-radius: 16px; padding-top:7px; padding-bottom:7px; padding-left:10px; padding-right:10px;">未达到</div>
										<img src="../_img/event_progress02.png" alt="이벤트 이미지">
									</div>
								</div>
								<div id="item03" class="benefit">
									<div class="right_img">
                                    <div id="img3" style="float:right; color: #fff; background-color: #D9D9D9; border-radius: 16px; padding-top:7px; padding-bottom:7px; padding-left:10px; padding-right:10px;">未达到</div>
										<img src="../_img/event_progress03.png" alt="이벤트 이미지">
									</div>
								</div>
							</div>
						</div>
                        <div class="event_info">
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
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>

    <!-- 모달 1000달러 받기 -->
    <div class="modal-layer show-modal01" data-modal="voucher1">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div style="text-align: center;">
                        <img src="/_img/voucher_save02.png">
                    </div>
                    <div class="modal-info__detail" style="text-align: center;"><p style="color:#207A80;">购买$1,000以上的顾客专享消费券</p>
                        <p>领取相应消费券吗？</p>
                        <div style="text-align: center; padding-bottom:10px; padding-top:5px;"><img src="/_img/Vector.svg" alt=""></div>
                    </div>
                    <div class="modal-info__detail">
                        <ul class="modal-info__list">
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>活动期间只能领取一次消费券(~24.05.31)</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>要领取更高金额的消费券，请在达到累计消费金额以后重新输入代码</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>已领取的消费券不可更改或取消。</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>消费券在<b>“我的页面>我的消费券＂</b>里可查看</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>客服中心　微信账号　Konnect8</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close" onclick="showVoucher1()">领取</button>
                </div>
            </div>
        </div>

    <!-- 모달 2000달러 받기 -->
    <div class="modal-layer show-modal02" data-modal="voucher2">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div style="text-align: center;">
                        <img src="/_img/voucher_save03.png">
                    </div>
                    <div class="modal-info__detail" style="text-align: center;"><p style="color:#207A80;">购买$2,000以上的顾客专享消费券</p>
                        <p>领取相应消费券吗？</p>
                        <div style="text-align: center; padding-bottom:10px; padding-top:5px;"><img src="/_img/Vector.svg" alt=""></div>
                    </div>
                    <div class="modal-info__detail">
                        <ul class="modal-info__list">
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>活动期间只能领取一次消费券(~24.05.31)</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>要领取更高金额的消费券，请在达到累计消费金额以后重新输入代码</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>已领取的消费券不可更改或取消。</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>消费券在<b>“我的页面>我的消费券＂</b>里可查看</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>客服中心　微信账号　Konnect8</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close" onclick="showVoucher2()">领取</button>
                </div>
            </div>
        </div>

    <!-- 모달 3000달러 받기 -->
    <div class="modal-layer show-modal03" data-modal="voucher3">
            <div class="modal-layer__window">
                <div class="modal-body">
                    <div style="text-align: center;">
                        <img src="/_img/voucher_save04.png">
                    </div>
                    <div class="modal-info__detail" style="text-align: center;"><p style="color:#207A80;">购买$3,000以上的顾客专享消费券</p>
                        <p>领取相应消费券吗？</p>
                        <div style="text-align: center; padding-bottom:10px; padding-top:5px;"><img src="/_img/Vector.svg" alt=""></div>
                    </div>
                    <div class="modal-info__detail">
                        <ul class="modal-info__list">
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>活动期间只能领取一次消费券(~24.05.31)</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>要领取更高金额的消费券，请在达到累计消费金额以后重新输入代码</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>已领取的消费券不可更改或取消。</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>消费券在<b>“我的页面>我的消费券＂</b>里可查看</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>客服中心　微信账号　Konnect8</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close" onclick="showVoucher3()">领取</button>
                </div>
            </div>
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
                let baseUrl= "/_img/voucher_progress01.png";

                let balance = res.balance;
                // let balance = 1000;

                let bkColor1 = "#F3F6F6"
                let bkColor2 = "#F3F6F6"
                let bkColor3 = "#F3F6F6"

                let color1 = "#89ABAD"
                let color2 = "#89ABAD"
                let color3 = "#89ABAD"

                if(balance >= 1000){
                    bkColor1 = "#207A80";
                    color1 = "#fff"
                    baseUrl = "/_img/voucher_progress02.png";
                    document.getElementById('img1').style.background = "#207A80"
                    document.getElementById('img1').innerHTML ="达到"
                    document.getElementById('test12').style.background = bkColor1
                    document.getElementById('test12').style.color = color1
                }
                if(balance >= 2000){
                    bkColor1 = "#207A80";
                    bkColor2 = "#207A80";
                    color1 = "#fff"
                    color2 = "#fff"
                    baseUrl = "/_img/voucher_progress03.png";
                    document.getElementById('img1').style.background = "#207A80"
                    document.getElementById('img1').innerHTML ="达到"
                    document.getElementById('img2').style.background = "#207A80"
                    document.getElementById('img2').innerHTML ="达到"
                    document.getElementById('test12').style.background = bkColor1
                    document.getElementById('test12').style.color = color1
                    document.getElementById('test13').style.background = bkColor2
                    document.getElementById('test13').style.color = color2
                }
                if(balance >= 3000){
                    bkColor1 = "#207A80";
                    bkColor2 = "#207A80";
                    bkColor3 = "#207A80";
                    color1 = "#fff"
                    color2 = "#fff"
                    color3 = "#fff"
                    baseUrl = "/_img/voucher_progress04.png";
                    document.getElementById('img1').style.background = "#207A80"
                    document.getElementById('img1').innerHTML ="达到"
                    document.getElementById('img2').style.background = "#207A80"
                    document.getElementById('img2').innerHTML ="达到"
                    document.getElementById('img3').style.background = "#207A80"
                    document.getElementById('img3').innerHTML ="达到"
                    document.getElementById('test12').style.background = bkColor1
                    document.getElementById('test12').style.color = color1
                    document.getElementById('test13').style.background = bkColor2
                    document.getElementById('test13').style.color = color2
                    document.getElementById('test14').style.background = bkColor3
                    document.getElementById('test14').style.color = color3
                }

                if(balance >= 3000 && status == 9){
                    let html = ""
                    $('.balance-controller').empty()
                    $('.balance-controller').append('<div>已完成活动参与</div>');
                }
                
                $('.codeAdd').append(
                        '<p style="padding-bottom:2px;">'+res.name+' 顾客的累</p>'+
                        '<p>计购买金额明细。</p>'
                )

                $('.voucher-progress').append(
                    '<img style="width:75%;" src="'+baseUrl+'" alt="">'
                )

                $.ajax({
                    type:"POST",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    dataType: "json",
                    data:{memberId:"<?=$member_idx?>"},
                    url: "https://concierge.fourdpocket.com/api/v1/voucherin/list/",
                    success: function (res) {
                        for(i=0;i<res.data.length;i++){
                            if(res.data[i].voucherCategory.type == "AMOUNT_1000"){
                                document.getElementById('img1').innerHTML ="已领取"
                            }
                            if(res.data[i].voucherCategory.type == "AMOUNT_2000"){
                                document.getElementById('img2').innerHTML ="已领取"
                            }
                            if(res.data[i].voucherCategory.type == "AMOUNT_3000"){
                                document.getElementById('img3').innerHTML ="已领取"
                            }

                            if(res.data[i].voucherCategory.type == "AMOUNT_1000" && res.data[i].status == 9){
                                document.getElementById('img1').innerHTML =""
                                document.getElementById('img1').style =" "
                                document.getElementById('item01').style ="opacity:0.3"
                            }
                            if(res.data[i].voucherCategory.type == "AMOUNT_2000" && res.data[i].status == 9){
                                document.getElementById('img2').innerHTML =" "
                                document.getElementById('img2').style =" "
                                document.getElementById('item02').style ="opacity:0.3"
                            }
                            if(res.data[i].voucherCategory.type == "AMOUNT_3000" && res.data[i].status == 9){
                                document.getElementById('img3').innerHTML =" "
                                document.getElementById('img3').style =" "
                                document.getElementById('item03').style ="opacity:0.3"
                                document.getElementById('balance-controller').style = "";
                            }
                            if(res.data.length == 4){
                                document.getElementById('balance-controller').style = '';
                                $('.balance-controller').empty()
                                $('.balance-controller').append('<div style="text-align: center; padding: 5px; padding-left:15px; padding-right:15px; margin:10px; margin-left: 50px; margin-right: 50px; border-radius: 16px; color:#fff; background: #207A80;"">已完成活动参与</div>');
                            }   
                        }
                    }
                });
            }
        });
    });
</script>

<script>
    function voucherSaver1(){
        
        if(document.getElementById('test12').style.background == "rgb(243, 246, 246)"){
            alert('要领取更高金额的消费券，请在达到累计消费金额以后重新输入代码')
            return ;
        }

        $.ajax({
            type: "POST",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            dataType: "json",
            data:{memberId:"<?=$member_idx?>"},
            url: "https://concierge.fourdpocket.com/api/v1/voucherin/list",
            success: function (res) {
                console.log(res)
                for(i=0;i < res.data.length;i++){
                    console.log(res.data[i].voucherCategory.type)
                    if(res.data[i].voucherCategory.type == "AMOUNT_1000"){
                        alert("消费券使用完毕。")
                        return ;
                    }

                }
                document.querySelector('.show-modal01').classList.add('on')
            }
        });

        $.ajax({
            type: "GET",
            url: "https://concierge.fourdpocket.com/api/v1/member/findByConciergeId/<?=$member_idx?>",
            success: function (res) {
                let balance = 1000;
                console.log(res);
                if(balance < 1000){
                    alert("要领取更高金额的消费券，请在达到累计消费金额以后重新输入代码")
                    return ;
                }
            }
        });
    }
    function voucherSaver2(){

        if(document.getElementById('test13').style.background == "rgb(243, 246, 246)"){
            alert('要领取更高金额的消费券，请在达到累计消费金额以后重新输入代码')
            console.log('tq')
            console.log(document.getElementById('test12').style.background)
            return ;
        }

        $.ajax({
            type: "POST",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            dataType: "json",
            data:{memberId:"<?=$member_idx?>"},
            url: "https://concierge.fourdpocket.com/api/v1/voucherin/list",
            success: function (res) {
                console.log(res)
                for(i=0;i < res.data.length;i++){
                    console.log(res.data[i].voucherCategory.type)
                    if(res.data[i].voucherCategory.type == "AMOUNT_2000"){
                        alert("消费券使用完毕。")
                        return ;
                    }

                }
                document.querySelector('.show-modal02').classList.add('on')
            }
        });

    }
    function voucherSaver3(){

        if(document.getElementById('test14').style.background == "rgb(243, 246, 246)"){
            alert('要领取更高金额的消费券，请在达到累计消费金额以后重新输入代码')
            console.log('tq')
            console.log(document.getElementById('test12').style.background)
            return ;
        }

        $.ajax({
            type: "POST",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            dataType: "json",
            data:{memberId:"<?=$member_idx?>"},
            url: "https://concierge.fourdpocket.com/api/v1/voucherin/list",
            success: function (res) {
                console.log(res)
                for(i=0;i < res.data.length;i++){
                    console.log(res.data[i].voucherCategory.type)
                    if(res.data[i].voucherCategory.type == "AMOUNT_3000"){
                        alert("消费券使用完毕。")
                        return ;
                    }

                }
                document.querySelector('.show-modal03').classList.add('on')
            }
        });

    }
</script>

<script>
    function showVoucher1(){

        var request = $.ajax({
                    type: 'POST',
                    data: {externalId:"<?=$row['shilla_id']?>",memberId:'<?=$member_idx?>',name:"<?=$row['passport_last_name']?>"+ "<?=$row['passport_first_name']?>",passportNum:"<?=$row['passport_num']?>",type:"AMOUNT_1000" ,voucher:""},
                    url: 'https://concierge.fourdpocket.com/api/v1/voucherin/come',
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    dataType: "json",
                    success:function(result){
                        console.log('ret : ' + result);
                        if(confirm("登记完成 \n领取相应消费券吗?")){
                            window.location.href = "/mypage/voucher_before_use.php"
                        }else{
                            window.location.reload()
                        }
                    }
            });
    }

    function showVoucher2(){

        var request = $.ajax({
                    type: 'POST',
                    data: {externalId:"<?=$row['shilla_id']?>",memberId:'<?=$member_idx?>',name:"<?=$row['passport_last_name']?>"+ "<?=$row['passport_first_name']?>",passportNum:"<?=$row['passport_num']?>",type:"AMOUNT_2000" ,voucher:""},
                    url: 'https://concierge.fourdpocket.com/api/v1/voucherin/come',
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    dataType: "json",
                    success:function(result){
                        console.log('ret : ' + result);
                        if(confirm("登记完成 \n领取相应消费券吗?")){
                            window.location.href = "/mypage/voucher_before_use.php"
                        }else{
                            window.location.reload()
                        }
                    }
            });
    }

    function showVoucher3(){

        var request = $.ajax({
                    type: 'POST',
                    data: {externalId:"<?=$row['shilla_id']?>",memberId:'<?=$member_idx?>',name:"<?=$row['passport_last_name']?>"+ "<?=$row['passport_first_name']?>",passportNum:"<?=$row['passport_num']?>",type:"AMOUNT_3000" ,voucher:""},
                    url: 'https://concierge.fourdpocket.com/api/v1/voucherin/come',
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    dataType: "json",
                    success:function(result){
                        console.log('ret : ' + result);
                        if(confirm("登记完成 \n领取相应消费券吗?")){
                            window.location.href = "/mypage/voucher_before_use.php"
                        }else{
                            window.location.reload()
                        }
                    }
            });
    }
</script>

</html>