<?php

include("../_inc/head.php");

// $member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
// if(!$member_idx){
// 	error_frame_go("로그인 후 이용 가능한 페이지입니다.", "/login/login.php");
// 	exit;
// }

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
            <div class="header__title">바우처 페이백 리워드</div>
        </header>
        <div class="mypage__container">
            <p style="text-align: center; padding-top:15px;">구매후 결제 금액에 맞춰 페이백 받아가세요.</p>
            <div style="text-align: center; padding-top:60px;">
                <?php $i=1; if($i ==1) {
                    echo '<img src="/_img/common/voucher_new_buyers_img.png">';
                } ?>
            </div>
            <div class="user-name" style="text-align: center; padding-top:60px;">
            </div>
            <div style="text-align: center; padding-top:30px;">
                <p style="padding-top: 30px;">-------------진행률 바 부분----------------</p>
            </div>

            <div class="balance-controller" style="width: 90%; margin: 10px auto; display: flex; text-align: center; padding-bottom:30px;"></div>

            <div style="padding-top: 20px;">
                <div style="border: 1px solid; padding-top:15px; padding-left:15px; padding-bottom:15px; margin-bottom:10px; margin-left:20px; margin-right:20px; border-radius: 10px; display: flex;">
                    <div style="flex:1; width:80%">
                        <p>Reward 1</p>
                        <p>$1,000 이상 구매 달성  바우처 발급완료! </p>
                    </div>
                    <div style="flex:1; width:20%; padding-right:0px;">
                        <button style="border-radius: 16px; background: #D9D9D9; padding-left:5px; padding-right:5px; margin-left:20px;">받기</button>
                    </div>
                </div>
                <div style="border: 1px solid; padding-top:15px; padding-left:15px; padding-bottom:15px; margin-bottom:10px; margin-left:20px; margin-right:20px; border-radius: 10px;">
                    <p>Reward 2</p>
                    <div style="display: flex;">
                        <p>$2,000 이상 구매 달성  바우처 발급완료! </p>
                        <button style="border-radius: 16px; background: #D9D9D9; padding-left:5px; padding-right:5px; margin-left:20px;">받기</button>
                    </div>
                </div>
                <div style="border: 1px solid; padding-top:15px; padding-left:15px; padding-bottom:15px; margin-bottom:10px; margin-left:20px; margin-right:20px; border-radius: 10px;">
                    <p>Reward 3</p>
                    <div style="display: flex;">
                        <p>$3,000 이상 구매 달성  바우처 발급완료! </p>
                        <button style="border-radius: 16px; background: #D9D9D9; padding-left:5px; padding-right:5px; margin-left:20px;">받기</button>
                    </div>
                </div>
            </div>

            <div style="text-align: center; padding-top:30px;">
                <p style="padding-bottom:30px;">-유의사항-</p>
                <ul>
                    <li style="color:#89ABAD; padding-bottom:7px;"><span style="color:#89ABAD">º</span>해당 이벤트는 신라면세점 제휴 이벤트 입니다.</li>
                    <li style="color:#89ABAD; padding-bottom:7px;"><span style="color:#89ABAD">º</span>해당 이벤트는 신라면세점 제휴 이벤트 입니다.</li>
                    <li style="color:#89ABAD; padding-bottom:7px;"><span style="color:#89ABAD">º</span>해당 이벤트는 신라면세점 제휴 이벤트 입니다.</li>
                    <li style="color:#89ABAD; padding-bottom:7px;"><span style="color:#89ABAD">º</span>해당 이벤트는 신라면세점 제휴 이벤트 입니다.</li>
                </ul>
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
        $.ajax({
            type: "GET",
            url: "https://concierge.fourdpocket.com/api/v1/member/findById/1",
            success: function (res) {
                console.log("첫번째 : "+document.getElementById('test12').style.backgroundColor)
                console.log("두번째 : "+ document.getElementById('test13').style.backgroundColor)
                console.log(res)

                // if(document.getElementById('test13').style.backgroundColor == "rgb(217, 217, 217)"){
                //     alert("이색은 아니에요")
                // } else if(document.getElementById('test13').style.backgroundColor == "rgb(32, 122, 128)") {
                //     alert("이색이에요")
                // }

                let html = ""
                $('.user-name').append(
                    '<p>'+res.name+' 님의</p>'+
                    '<p>구매 금액 달성 내역입니다. </p>'
                )
            }
        })
    </script>
    <script>
         $.ajax({
            type: "GET",
            url: "https://concierge.fourdpocket.com/api/v1/member/findById/1",
            success: function (res) {
                let color1 = "#D9D9D9"
                let color2 = "#D9D9D9"
                let color3 = "#D9D9D9"
                console.log(color1);

                let balance = 0;

                if(balance >= 1000){
                    color1 = "#207A80";
                }
                if(balance >= 2000){
                    color1 = "#207A80";
                    color2 = "#207A80";
                }
                if(balance >= 3000){
                    color1 = "#207A80";
                    color2 = "#207A80";
                    color3 = "#207A80"; 
                }
                
                console.log(color1)

                $('.balance-controller').append(
                    '<div style="flex:1; width:30%; box-sizing: border-box;"><p>$1,000</p>'+
                    '<button id="test12" type="button" style="padding-top: 5px; margin-top:10px; border-radius: 16px; background: '+color1+';" onclick="rewardGet1()">리워드'+ '받기</button></div><div style="flex:1; width:30%; box-sizing: border-box;"><p>$2,000</p>'+
                    '<button id="test13" type="button" style="padding-top: 5px; margin-top:10px; border-radius: 16px; background: '+color2+';" onclick="rewardGet2()">리워드'+ '받기</button></div><div style="flex:1; width:30%; box-sizing: border-box;"><p>$3,000</p>'+
                    '<button id="test14" type="button" style="padding-top: 5px; margin-top:10px; border-radius: 16px; background: '+color3+';" onclick="rewardGet3()">리워드 받기</button>'+
                    '</div>'
                   );
            }
        });
    </script>
    <script>
        function rewardGet1(){
            if(document.getElementById('test12').style.backgroundColor == "rgb(32, 122, 128)"){
                alert("굳걸")
            }
        }
        function rewardGet2(){
            if(document.getElementById('test13').style.backgroundColor == "rgb(32, 122, 128)"){
                alert("굳걸")
            }
        }
        function rewardGet3(){
            if(document.getElementById('test14').style.backgroundColor == "rgb(32, 122, 128)"){
                alert("굳걸")
            }
        }
    </script>
</body>
</html>