<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$passport_num = trim(sqlfilter($_REQUEST['passport_num']));

$query = " SELECT `idx` FROM member_info WHERE `passport_num` = '$passport_num' LIMIT 1 ";
$result = mysqli_query($gconnet, $query);

echo json_encode(['code' => $result->num_rows]);