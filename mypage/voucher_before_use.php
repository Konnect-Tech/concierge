<?php

include("../_inc/head.php");

$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
if(!$member_idx){
	error_frame_go("로그인 후 이용 가능한 페이지입니다.", "/login/login.php");
	exit;
}

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
                    <div class="mypage-tab">
                        <a href="/mypage/voucher_before_use.php" class="tab on">사용전</a>
                        <a href="/mypage/voucher_after_use.php" class="tab">사용후</a>
                    </div>
                    <div class="ex benefits_list" style="padding-left: 20px; padding-right:20px;">
                    </div>
                </section>
            </div>
        </main>

        	<!-- 바우처 없음 모달 시작 -->
			<div class="modal-layer" data-modal="not-result">
			<div class="modal-layer__window">
				<div class="modal-body">
					<div class="modal-center__content">
						<p>
							보유하신 바우처가 없습니다
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

<script type="text/javascript">
    $(".point-category>a").on("click",function(){
        $(".point-category>a").removeClass("on");
        $(this).addClass("on");
    });
</script>
<script>

    window.onload = function getVoucher() {
        var request = $.ajax({
        type: 'POST',
        data: {memberId:<?=$member_idx?>},
        url: 'https://concierge.fourdpocket.com/api/v1/voucherin/list',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        dataType: "json",
        success:function(result){
            let html = "";
            console.log(result)
                    for(i=0;i<result.data.length;i++){

                        // if(result.data[i].status != 0){
                        //     $('.ex').append('<div class="no-list__wrap"><img src="/_img/mypage/no_point_img.png" alt=""> <p>등록된 바우처가 없습니다.</p> </div>')

                        //     return ;
                        // }

                        if(result.data[i].status == 0){
                            let data = "'"+result.data[i].voucherCategory.type+"'";
                            $('.ex').append(
                            '<div class="benefit" style="cursor: pointer; margin-bottom:15px;" onclick="test('+data+')">'+
                            '<em class="benefit__title" style="padding-left:0px; margin-bottom: 10px;">EVENT VOUCHER</em>'+
                            '<div style="display: flex;">'+
                            '<div style="width:50%; margin-top:20px;"><span style="font-weight:bold;">'+result.data[i].voucherCategory.title+'</span></div>'+
                            '<div style="display:inline-block"><img style="width:150px; height:102px; flex-shrink: 0;" src="'+result.data[i].voucherCategory.thumbnail+'" alt=""> </div>'+ 
                            '</div>'
                            );
                        }
                    }

        }
    });
    }
</script>

<script>
    function test(data){
        console.log(data);
        window.location.href = "/mypage/voucher_use_detail.php?data="+data;
    }
</script>

<script>
    window.addEventListener('load', function(){
        var request = $.ajax({
        type: 'POST',
        data: {memberId:<?=$member_idx?>,status:"0"},
        url: 'https://concierge.fourdpocket.com/api/v1/voucherin/listByStatus',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        dataType: "json",
        success:function(result){
            if(result.data.length == 0) {
                document.querySelector('.modal-layer').classList.add('on')
            }
        }
        });
    });
</script>

</body>
</html>