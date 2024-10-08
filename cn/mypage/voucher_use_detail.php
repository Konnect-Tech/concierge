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
            <div class="header__title">我的消费券</div>
        </header>
        <div class="mypage__container" style="padding-bottom: 60px;">
            <div class="voucher-thumbnail-controller" style="text-align: center; padding-top:60px;"></div>
            <div class="voucher-text-controller" style="text-align: center; padding-top:60px;"></div>
            <div style="text-align: center;"><span>特殊礼包交换券</span></div>
            <div style="text-align: center;"><span>交换处：新罗免税店 首尔店１楼 服务台</span></div>
            <div class="voucher-img-controller" style="padding-top: 30px; text-align: center;" ></div>
            <div style="padding-top: 100px;"><button style="text-align: center;" id="test" type="button" class="btn btn-radius on btn-modal"data-modal="voucher">员工确认</button></div>
            <p style="text-align: center; padding-top:10px; color:#207A80;">请服务台员工（非顾客本人）点击确认。</p>
        </div>
        <br>
    </div>
    <?php include("../_inc/menu.php"); ?>

    <!-- 모달 -->
            <!-- onclick="location.href='/mypage/voucher_use.php'" -->
    <div class="modal-layer" data-modal="voucher">
    <div class="modal-layer__window">
        <div class="modal-body">
            <p class="modal__text">无法取消使用，<br>确认要使用吗？</p>
        </div>
        <div class="button__wrap">
            <button type="button" class="btn btn-radius btn-close">不使用</button>
            <button type="button" class="btn btn-radius on" onclick="voucherUsed()">使用</button>
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
            console.log(result,"11111111111111")
            console.log(<?=$member_idx?>)
            for(i=0;i < result.data.length;i++){
                if(getParameterByName("data") == result.data[i].voucherCategory.type){
                    let html = ""
                    $('.voucher-thumbnail-controller').append('<img style="width:70%" src="'+result.data[i].voucherCategory.thumbnailCn+'" alt="">')
                    $('.voucher-img-controller').append('<img src="'+result.data[i].voucherCategory.contentImageCn+'?3243" alt="">')
                    $('.voucher-text-controller').append('<div><span><b>'+result.data[i].voucherCategory.titleCn+'</b></span></div><br>')
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
                console.log(result,"11111111111111")
                console.log(<?=$member_idx?>)
                for(i=0;i < result.data.length;i++){
                    if(getParameterByName("data") == result.data[i].voucherCategory.type){
                        var request = $.ajax({
                        type: 'POST',
                        data: {conciergeId:<?=$member_idx?>, voucher:result.data[i].voucher},
                        url: 'https://concierge.fourdpocket.com/api/v1/voucherin/use',
                        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                        dataType: "json",
                        success:function(result){
                                window.location.href = "/cn/mypage/voucher_use.php?type="+getParameterByName("data");
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