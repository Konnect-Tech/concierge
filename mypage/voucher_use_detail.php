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
        <div class="mypage__container" style="padding-bottom: 60px;">
            <div class="voucher-thumbnail-controller" style="text-align: center; padding-top:60px;"></div>
            <div class="voucher-text-controller" style="text-align: center; padding-top:60px;"></div>
            <div style="text-align: center;"><span style="color:#207A80;">스페셜 기프트 교환권</span></div>
            <div style="text-align: center;"><span style="font-size: 13px;">(교환처 : 신라면세점 서울점 1층 안내데스크)</span></div>
            <div class="voucher-img-controller" style="padding-top: 30px; text-align: center;" ></div>
            <div style="padding-top: 100px;"><button style="text-align: center;" id="test" type="button" class="btn btn-radius on btn-modal"data-modal="voucher">직원 확인</button></div>
            <p style="text-align: center; padding-top:10px; color:#207A80;">*본인이 아닌 데스크 직원이 확인 버튼을 눌러주세요</p>
        </div>
        <br>
    </div>
    <?php include("../_inc/menu.php"); ?>

    <!-- 모달 -->
            <!-- onclick="location.href='/mypage/voucher_use.php'" -->
    <div class="modal-layer" data-modal="voucher">
    <div class="modal-layer__window">
        <div class="modal-body">
            <p class="modal__text">사용취소가 되지 않습니다.<br>정말 사용하시겠습니까?</p>
        </div>
        <div class="button__wrap">
            <button type="button" class="btn btn-radius btn-close">아니요</button>
            <button type="button" class="btn btn-radius on" onclick="voucherUsed()">사용하기</button>
        </div>
    </div>
    </div>


</body>
<script type="text/javascript">
        $(".point-category>a").on("click",function(){
            $(".point-category>a").removeClass("on");
            $(this).addClass("on");
        });
    </script>

    <script>
        function getParameterByName(name) {

            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");

            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),

                    results = regex.exec(location.search);

            return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));

        }
        
        var request = $.ajax({
        type: 'POST',
        data: {memberId:<?=$member_idx?>},
        url: 'https://concierge.fourdpocket.com/api/v1/voucherin/list',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        dataType: "json",
        success:function(result){
            for(i=0;i < result.data.length;i++){
                if(getParameterByName("data") == result.data[i].voucherCategory.type){
                    let html = ""
                    $('.voucher-thumbnail-controller').append('<img style="width:70%" src="'+result.data[i].voucherCategory.thumbnail+'" alt="">')
                    $('.voucher-img-controller').append('<img src="'+result.data[i].voucherCategory.contentImage+'" alt="">')
                    $('.voucher-text-controller').append('<div><span><b>'+result.data[i].voucherCategory.title+'</b></span></div><br>')
                    console.log(result.data[i].voucherCategory.type)
                }
            }
        }
        });
    </script>
    <script>
        function voucherUsed(){

            var request = $.ajax({
            type: 'POST',
            data: {memberId:<?=$member_idx?>},
            url: 'https://concierge.fourdpocket.com/api/v1/voucherin/list',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            dataType: "json",
            success:function(result){
                for(i=0;i < result.data.length;i++){
                    if(getParameterByName("data") == result.data[i].voucherCategory.type){
                        var request = $.ajax({
                        type: 'POST',
                        data: {conciergeId:<?=$member_idx?>, voucher:result.data[i].voucher},
                        url: 'https://concierge.fourdpocket.com/api/v1/voucherin/use',
                        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                        dataType: "json",
                        success:function(result){
                            window.location.href = "/mypage/voucher_use.php?type="+getParameterByName("data");
                            }
                        });
                    }
                    if(getParameterByName("data") == "AMOUNT_3000"){
                        var xhr = new XMLHttpRequest();
                        xhr.open("GET", "../extra/extra_voucher_give_action.php", true);
                        xhr.send();
                    }
                }
            }
            });
        }
    </script>
</html>