<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
if(!$member_idx){
	error_frame_go("登录后即可看到此页面。", "/login/login.php");
	exit;
}

$promotion_code = trim(sqlfilter($_REQUEST['promotion_code']));

$secret_key = "KoNcSecUre_SeCe_RT__@#Key_Sid23S";
$secret_iv = "커넥트_컨시어지_프로모션_해독 !@^%%#$@";
$data = [
	"result_state" => true,
	"data" => [
		"promotion_code" => $promotion_code,
		"member_code" => $_SESSION[$_SESSION_DEFAULT_PREFIX . "code"]
	]
];
$token = jwt_encrypt($data, $secret_key, $secret_iv);

no_error_go("https://medical.konnect-promo.com/?token=$token&locale=ZH");