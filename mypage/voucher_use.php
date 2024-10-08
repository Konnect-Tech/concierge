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
                <button type="button" style="  display: inline-block;
  width: 20px;
  height: 20px;
  background: url(../_img/common/icon_back.svg) no-repeat center center / 18px 15px;" onclick="location.href='/mypage/voucher_after_use.php'"></button>
            </div>
            <div class="header__title">나의 바우처</div>
        </header>
        <div class="mypage__container">
            <div class="img" style="text-align: center; padding-top:60px;"></div>
            <div style="text-align: center; padding-top:60px;">
                <div><p>바우처 사용이 완료되었어요</p></div>
                <div><p>커넥트 컨시어지의 다양한 이벤트를</p></div>
                <div><p style="margin-top: 5px;">통해 더 많은 바우처를 획득하세요:)</p></div>
            </div>

        <?php include("../_inc/menu.php"); ?>

    </div>

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

        window.onload = function(){
            console.log(getParameterByName('type'))
            if(getParameterByName('type') == "SIGN_UP"){
                $('.img').append('<img src="/_img/common/voucher_new_buyers.png">')
            }
            if(getParameterByName('type') == "AMOUNT_1000"){
                $('.img').append('<img src="/_img/common/voucher_1000.png">')
            }
            if(getParameterByName('type') == "AMOUNT_2000"){
                $('.img').append('<img src="/_img/common/voucher_2000.png">')
            }
            if(getParameterByName('type') == "AMOUNT_3000"){
                $('.img').append('<img src="/_img/common/voucher_3000.png">')
            }
        }
    </script>
</body>
</html>