<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$user_last_name = trim(sqlfilter($_REQUEST['user_last_name']));
$user_first_name = trim(sqlfilter($_REQUEST['user_first_name']));
$phone_code = trim(sqlfilter($_REQUEST['phone_code']));
$phone_num = trim(sqlfilter($_REQUEST['phone_num']));

$query = " SELECT `user_id` FROM member_info WHERE ";
$query .= " `user_last_name` = '$user_last_name' AND ";
$query .= " `user_first_name` = '$user_first_name' AND ";
$query .= " `phone_code` = '$phone_code' AND ";
$query .= " `phone_num` = '$phone_num' ";
$result = mysqli_query($gconnet, $query);
if($result->num_rows === 0){
	?>
	<script>
        parent.modalLayerOpen()
	</script>
<?php
	exit;
}
$row = $result->fetch_array();

frame_go("./find_id_result.php?id=" . $row['user_id']);