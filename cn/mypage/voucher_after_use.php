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
            <div class="header__title">我的活动信息</div>
        </header>
        <main class="main">
            <div class="mypage__container">
                <section class="mypage-point">
                    <div class="mypage-tab">
                        <a href="/cn/mypage/voucher_before_use.php" class="tab">使用前</a>
                        <a href="/cn/mypage/voucher_after_use.php" class="tab on">使用后</a>
                    </div>
                    <div class="ex benefits_list" style="padding-left: 20px; padding-right:20px;">
                    </div>
                </section>
            </div>
        </main>

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

                        // if(result.data[i].status != 9){
                        //     $('.ex').append('<div class="no-list__wrap"><img src="/_img/mypage/no_point_img.png" alt=""> <p>등록된 바우처가 없습니다.</p> </div>')

                        //     return ;
                        // }

                        if(result.data[i].status == 9){
                            let data = "'"+result.data[i].voucherCategory.type+"'";
                            $('.ex').append(
                            '<div class="benefit" style="opacity:0.3; margin-bottom:15px;">'+
                            '<em class="benefit__title" style="padding-left:0px; margin-bottom: 10px;">EVENT VOUCHER</em>'+
                            '<div style="display: flex;">'+
                            '<div style="width:50%; margin-top:20px;"><span style="font-weight:bold;">'+result.data[i].voucherCategory.titleCn+'</span></div>'+
                            '<div style="display:inline-block"><img style="width:150px; height:102px; flex-shrink: 0;" src="'+result.data[i].voucherCategory.thumbnailCn+'" alt=""> </div>'+ 
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

</body>
</html>