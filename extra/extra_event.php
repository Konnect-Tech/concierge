<?php include("../_inc/head.php"); 
	$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
?>
<body>
	<div id="wrap">
		<header id="header">
			<div class="header__inner">
				<button type="button" class="btn_back"></button>
			</div>
			<div class="header__title">이벤트</div>
		</header>
		<main class="main">
			<div id="container" class="event_container">
				<div class="event__inner">
					<div class="event_first">
						<div class="event_first__inner">
						</div>
					</div>
					<div class="event_etc">
						<div><br><span id="text" style="font-size: 20px; font-weight:bold;"></span></div>
						<br><br>
						<div class="code-controller"></div>
						<div><br><span style="font-size: 20px; font-weight:bold;">이벤트 혜택</span></div>
						<div class="join_benefits">
							<div class="benefits_list">
								<div class="benefit">
									<div class="right_img">
										<img src="../_img/event_item01.png" alt="이벤트 이미지">
									</div>
								</div>
								<div class="benefit">
									<div class="right_img">
										<img src="../_img/event_item02.png" alt="이벤트 이미지">
									</div>
								</div>
								<div class="benefit">
									<div class="right_img">
										<img src="../_img/event_item03.png" alt="이벤트 이미지">
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
					document.getElementById('text').innerText = "신라면세점 x 커넥트 바우처 받기";
                    $('.code-controller').append(
                        '<br><div style="text-align: center; padding-top: 0px">'+
                        '<input class="common-input" id="codeSave" type="textara" placeholder="코드를 입력하고 바우처를 받으세요"></div>'+
                        '<br><div style="text-align:center;  display: flex; align-items: center;gap: 16PX;  flex: 1;">'+
                        '<button style="width: 50%; height: 48px; line-height: 48px; display: inline-block; background-color: #F3F6F6;color: #89ABAD;'+ 'text-align: center; cursor: pointer; border-radius: 10px;"  type="button"  onclick="checkCode()">코드받기</button>'+
                        '<button id="test" style="width: 50%; height: 48px; line-height: 48px; display: inline-block; background-color: #207A80; color: #fff;'+ 'text-align: center; cursor: pointer; border-radius: 10px;" type="button" onclick="saveVoucher()">바우처 받기</button>'+
                        '</div>'
                    );
                    console.log(document.getElementById('test').style.backgroundColor)
                }else{
					document.getElementById('text').innerText = "신라면세점 x 커넥트 바우처 받기";
                    $('.code-controller').append(
                        ' <div class="button__wrap">'+
                         '<button type="button" class="btn btn-radius" style="color: #fff; background-color: #207A80;" onclick="voucherProgress()">바우처 확인하기</button>'+
                         '</div>'
                    );
                }
            }
        });
    });
</script>

<script>
	function voucherProgress(){
		window.location.href = "/extra/extra_voucher_progress.php"
	}
</script>

<script>
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

	function checkCode() {
        window.open('https://m.shilladfs.com/estore/kr/zh/event/eventView?eventId=E71362','','');
    }
</script>



</html>