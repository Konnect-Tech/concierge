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
					<div id="balance-controller" class="balance-controller" style="width: 90%; margin: 10px auto; display: flex; text-align: center;">
                        <div style="flex:1; width:30%; box-sizing: border-box; padding-top:0px;">
                            <button id="test12" style="padding: 5px; padding-left:15px; padding-right:15px; margin:10px; border-radius: 16px; color:#89ABAD ; background: #F3F6F6;" onclick="voucherSaver1()">받기</button>
                        </div>
                        <div style="flex:1; width:30%; box-sizing: border-box; padding-top:0px;">
                            <button id="test13" style="padding-top:0px; padding: 5px; padding-left:15px; padding-right:15px; margin-top:10px; border-radius: 16px; color:#89ABAD ; background: #F3F6F6;" onclick="voucherSaver2()">받기</button>
                        </div>
                        <div style="flex:1; width:30%; box-sizing: border-box; padding-top:0px;">
                            <button id="test14" style="padding-top:0px; padding: 5px; padding-left:15px; padding-right:15px; margin-top:10px; border-radius: 16px; color:#89ABAD ; background: #F3F6F6;" onclick="voucherSaver3()">받기</button>
                        </div>
                    </div>
                    <!-- <div class="balance-controller2" style="width: 90%; margin: 10px auto; display: flex; text-align: center; padding-bottom:30px;">
                        <div style="flex:1; width:30%; box-sizing: border-box; padding-top:10px;">
                            <button id="test12" type="button" style="padding: 5px; margin-top:10px; border-radius: 16px; color:#89ABAD ; background: #F3F6F6;" onclick="voucherSaver1()" class="btn-modal" data-modal="voucher">받기</button>
                            <button id="test13" type="button" style="padding: 5px; margin-top:10px; border-radius: 16px; color:#89ABAD ; background: #F3F6F6;" onclick="voucherSaver2()" class="btn-modal" data-modal="voucher">받기</button>
                            <button id="test14" type="button" style="padding: 5px; margin-top:10px; border-radius: 16px; color:#89ABAD ; background: #F3F6F6;" onclick="voucherSaver3()" class="btn-modal" data-modal="voucher">받기</button>  
                        </div>
                    </div>   -->
					<div class="event_etc">
						<br><br>
						<div style="text-align: center;"><br><span style="font-size: 20px; font-weight:bold;">누적 구매금액을 달성하여</span></div>
                        <div style="text-align: center;"><span style="font-size: 20px; font-weight:bold;">원하시는 혜택 1개를 받으세요 :)</span></div>
						<div class="join_benefits">
							<div class="benefits_list">
								<div class="benefit">
									<div id="item01" class="right_img">
										<div id="img1" style="float:right; color: #fff; background-color: #D9D9D9; border-radius: 16px; padding-top:7px; padding-bottom:7px; padding-left:10px; padding-right:10px;">미달성</div>
										<img class="btn-modal" data-modal="voucher" src="../_img/event_progress01.png" alt="이벤트 이미지">
									</div>
								</div>
								<div class="benefit">
									<div id="item02" class="right_img">
                                    <div id="img2" style="float:right; color: #fff; background-color: #D9D9D9; border-radius: 16px; padding-top:7px; padding-bottom:7px; padding-left:10px; padding-right:10px;">미달성</div>
										<img src="../_img/event_progress02.png" alt="이벤트 이미지">
									</div>
								</div>
								<div class="benefit">
									<div id="item03" class="right_img">
                                    <div id="img3" style="float:right; color: #fff; background-color: #D9D9D9; border-radius: 16px; padding-top:7px; padding-bottom:7px; padding-left:10px; padding-right:10px;">미달성</div>
										<img src="../_img/event_progress03.png" alt="이벤트 이미지">
									</div>
								</div>
							</div>
						</div>
                        <div class="event_info">
							<div class="event_info-item">
								<br>
                                <div style="text-align: center; padding-bottom:10px;"><img src="/_img/Vector.svg" alt=""></div>
								<h3>이벤트 신청 전, 꼭 확인하세요!</h3>
								<ul>
									<li>바우처 받기는 <b>'이벤트 기간내 1회만 신청 가능'</b> 합니다.</li>
									<li>더 높은 금액의 바우처를 받으시려면, 필요한 누적금액을 달성 후 받기를 진행해주세요.</li>
									<li><b>출국확인 된 분에 한해 적용</b>되니 가입 시, 여권정보를 정확히 입력해주세요.</li>
									<li>누적 구매금액은 출국 후 7~10일 내에 반영이 됩니다.(영업일 기준)</li>
									<li>발급 된 바우처는 변경 및 취소가 되지 않습니다.</li>
									<li>바우처는<b>'마이페이>나의바우처'</b>에서 확인 하실 수 있습니다.</li>
								</ul>
							</div>
							<div class="event_info-item">
								<h3>- 유의사항 -</h3>
								<ul>
									<li>해당 이벤트는 신라면세점 제휴 이벤트 입니다.</li>
									<li>이 이벤트는 이벤트 시작일로부터 커넥트 컨시어지에 가입된 고객에 한해 제공됩니다.</li>
									<li>상품 교환은 신라면세점 서울점 1층 안내데스크에서 제공합니다.</li>
									<li>메디컬 바우처는 1회 제공되며, 제휴된 병원 프로모션 시술을 예약할 수 있습니다.</li>
									<li>사용자의 귀책(회원 탈퇴 등)으로 혜택을 받지 못할 경우 재발급이 불가능 합니다.</li>
									<li>명의도용, 중복 가입 등으로 이벤트 참여한 것이 확인되면 혜택은 지급되지 않습니다.</li>
									<li>이 이벤트는 자사의 사정에 따라 사전 고지 없이 내용 변경 및 조기 종료될 수 있습니다.</li>
									<li>기타 문의 사항은 고객센터 - 위챗 아이디 <b>konnect8</b>로 문의해주세요.</li>
								</ul>
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
                    <div class="modal-info__detail" style="text-align: center;"><p style="color:#207A80;">$1,000이상 구매고객용 바우처</p>
                        <p>해당 바우처를 받으시겠어요?</p>
                        <div style="text-align: center; padding-bottom:10px; padding-top:5px;"><img src="/_img/Vector.svg" alt=""></div>
                    </div>
                    <div class="modal-info__detail">
                        <ul class="modal-info__list">
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>바우처 받기는 이벤트 기간내 1회만 가능합니다 (~24.04.04)</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>더 높은 금액의 바우처를 받으려면 필요 누적 구매 금액을 달성 후 코드를 다시 입력하세요</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>받은 바우처는 변경 및 취소가 되지 않습니다</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span><span style="color:#89ABAD">바우처는 <b>"마이페이지>나의바우처"</b> 에서 확인하 실 수 있어요</span></li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>고객센터 위챗 ID : Konnect8</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close" onclick="showVoucher1()">받기</button>
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
                    <div class="modal-info__detail" style="text-align: center;"><p style="color:#207A80;">$2,000이상 구매고객용 바우처</p>
                        <p>해당 바우처를 받으시겠어요?</p>
                        <div style="text-align: center; padding-bottom:10px; padding-top:5px;"><img src="/_img/Vector.svg" alt=""></div>
                    </div>
                    <div class="modal-info__detail">
                        <ul class="modal-info__list">
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>바우처 받기는 이벤트 기간내 1회만 가능합니다 (~24.04.04)</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>더 높은 금액의 바우처를 받으려면 필요 누적 구매 금액을 달성 후 코드를 다시 입력하세요</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>받은 바우처는 변경 및 취소가 되지 않습니다</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span><span style="color:#89ABAD">바우처는 <b>"마이페이지>나의바우처"</b> 에서 확인하 실 수 있어요</span></li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>고객센터 위챗 ID : Konnect8</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close" onclick="showVoucher2()">받기</button>
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
                    <div class="modal-info__detail" style="text-align: center;"><p style="color:#207A80;">$3,000이상 구매고객용 바우처</p>
                        <p>해당 바우처를 받으시겠어요?</p>
                        <div style="text-align: center; padding-bottom:10px; padding-top:5px;"><img src="/_img/Vector.svg" alt=""></div>
                    </div>
                    <div class="modal-info__detail">
                        <ul class="modal-info__list">
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>바우처 받기는 이벤트 기간내 1회만 가능합니다 (~24.04.04)</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>더 높은 금액의 바우처를 받으려면 필요 누적 구매 금액을 달성 후 코드를 다시 입력하세요</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>받은 바우처는 변경 및 취소가 되지 않습니다</li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span><span style="color:#89ABAD">바우처는 <b>"마이페이지>나의바우처"</b> 에서 확인하 실 수 있어요</span></li>
                            <li style="color:#89ABAD"><span style="color:#89ABAD">º</span>고객센터 위챗 ID : Konnect8</li>
                        </ul>
                    </div>
                </div>
                <div class="button__wrap">
                    <button type="button" class="btn btn-radius btn-close" onclick="showVoucher3()">받기</button>
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
                // let balance = 3000;

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
                    document.getElementById('img1').innerHTML ="달성"
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
                    document.getElementById('img1').innerHTML ="달성"
                    document.getElementById('img2').style.background = "#207A80"
                    document.getElementById('img2').innerHTML ="달성"
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
                    document.getElementById('img1').innerHTML ="달성"
                    document.getElementById('img2').style.background = "#207A80"
                    document.getElementById('img2').innerHTML ="달성"
                    document.getElementById('img3').style.background = "#207A80"
                    document.getElementById('img3').innerHTML ="달성"
                    document.getElementById('test12').style.background = bkColor1
                    document.getElementById('test12').style.color = color1
                    document.getElementById('test13').style.background = bkColor2
                    document.getElementById('test13').style.color = color2
                    document.getElementById('test14').style.background = bkColor3
                    document.getElementById('test14').style.color = color3
                }

                $('.codeAdd').append(
                        '<p style="padding-bottom:2px;">'+res.name+' 님의</p>'+
                        '<p>누적 구매금액 내역입니다.</p>'
                )

                $('.voucher-progress').append(
                    '<img style="width:75%;" src="'+baseUrl+'" alt="">'
                )
                console.log(document.getElementById('img1').innerHTML)

                $.ajax({
                    type:"POST",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    dataType: "json",
                    data:{memberId:"<?=$member_idx?>"},
                    url: "https://concierge.fourdpocket.com/api/v1/voucherin/list/",
                    success: function (res) {
                        for(i=0;i<res.data.length;i++){
                            if(res.data[i].voucherCategory.type == "AMOUNT_1000"){
                                document.getElementById('img1').innerHTML ="받기완료"
                            }
                            if(res.data[i].voucherCategory.type == "AMOUNT_2000"){
                                document.getElementById('img2').innerHTML ="받기완료"
                            }
                            if(res.data[i].voucherCategory.type == "AMOUNT_3000"){
                                document.getElementById('img3').innerHTML ="받기완료"
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

                            if(res.data.length == 4) {
                                document.getElementById('balance-controller').style = '';
                                $('.balance-controller').empty()
                                $('.balance-controller').append('<div style="text-align: center; padding: 5px; padding-left:15px; padding-right:15px; margin:10px; margin-left: 50px; margin-right: 50px; border-radius: 16px; color:#fff; background: #207A80;"">이벤트 참여가 완료 되었습니다.</div>');
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
            alert('누적금액이 부족합니다.')
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
                        alert("이미 바우처 받기를 완료했습니다.")
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
                    alert("누적금액이 부족합니다.")
                    return ;
                }
            }
        });
    }
    function voucherSaver2(){

        if(document.getElementById('test13').style.background == "rgb(243, 246, 246)"){
            alert('누적금액이 부족합니다.')
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
                        alert("이미 바우처 받기를 완료했습니다.")
                        return ;
                    }

                }
                document.querySelector('.show-modal02').classList.add('on')
            }
        });

    }
    function voucherSaver3(){

        if(document.getElementById('test14').style.background == "rgb(243, 246, 246)"){
            alert('누적금액이 부족합니다.')
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
                        alert("이미 바우처 받기를 완료했습니다.")
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
                        if(confirm("정상적으로 등록 되었습니다. \n바우처를 확인하러 가시겠습니까?")){
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
                        if(confirm("정상적으로 등록 되었습니다. \n바우처를 확인하러 가시겠습니까?")){
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
                        if(confirm("정상적으로 등록 되었습니다. \n바우처를 확인하러 가시겠습니까?")){
                            window.location.href = "/mypage/voucher_before_use.php"
                        }else{
                            window.location.reload()
                        }
                    }
            });
    }
</script>

</html>