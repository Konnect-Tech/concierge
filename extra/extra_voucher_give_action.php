<?php

include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드

$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];

$query = " UPDATE member_info SET ";
$query .= " `voucher_state` = '1', ";
$query .= " `voucher_date` = NOW(), ";
$query .= " `used_voucher` = '0' ";
$query .= " WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);

error_frame_reload("바우처를 지급했습니다.");
?>
