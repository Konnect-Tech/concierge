<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_code = trim(sqlfilter($_REQUEST['member_code']));
if(!$member_code){
	error_frame("회원 코드를 제대로 입력해주세요.");
	exit;
}

$member_query = " SELECT * FROM member_info WHERE `member_code` = '$member_code' ";
$member_result = mysqli_query($gconnet, $member_query);
if(!$member_result->num_rows){
	error_frame("회원을 찾지 못했습니다.");
	exit;
}

$member_row = $member_result->fetch_array();
$member_idx = $member_row['idx'];

$reserve_data = get_reservations($member_row['user_id']);
if(!count($reserve_data)){
	?>
	<script>
		parent.not_reserved();
	</script>
<?php
	exit;
}

$reserve_data = $reserve_data[0];

$reserve_id = $reserve_data['_id'];
$phone_num = $member_row['phone_num'];
$passport_num = $member_row['passport_num'];
$user_name = $member_row['user_name'];
$birthday = $member_row['birthday'];
$gender_format = $member_row['gender_format'] == 0 ? 'Male' : 'Female';

$point_query = "
SELECT COALESCE(SUM(CASE WHEN c.currency = 'D' THEN c.amount ELSE 0 END), 0) AS D_total
FROM member_info AS m
LEFT JOIN currency_info AS c ON m.idx = c.member_idx
WHERE m.idx = '$member_idx'
GROUP BY m.idx
";
$point_result = mysqli_query($gconnet, $point_query);
$point_row = $point_result->fetch_array();
$have_d_point = $point_row['D_total'];

$hospital = $reserve_data['hospital']['name'];
$reserve_date = substr($reserve_data['appointmentAt'], 0, 10);
$reserve_uuid = $reserve_data['uuid'];

$procedure = "불러오기 실패";
$hospital_code = "";
$promotion_idx = "";

$promotion_query = " SELECT `idx`,`procedure`,`hospital_code` FROM promotion_info WHERE `hospital_id` = '" . $reserve_data['hospital']['_id'] . "' ";
$promotion_result = mysqli_query($gconnet, $promotion_query);
if($promotion_result->num_rows > 0){
	$promotion_row = $promotion_result->fetch_array();
	$procedure = $promotion_row['procedure'];
	$hospital_code = $promotion_row['hospital_code'];
	$promotion_idx = $promotion_row['idx'];
}

?>

<script>
	parent.reserve_data_parsing(
        '<?=$member_idx?>',
		'<?=$reserve_id?>',
        '<?=$reserve_data['hospital']['_id']?>',
        '<?=$hospital_code?>',
		'<?=$member_code?>',
		'<?=$phone_num?>',
		'<?=$passport_num?>',
		'<?=$user_name?>',
		'<?=$birthday?>',
		'<?=$gender_format?>',
		'<?=$have_d_point?>',
		'<?=$hospital?>',
		<?=json_encode(nl2br($procedure), JSON_UNESCAPED_UNICODE | JSON_HEX_TAG)?>,
		'<?=$reserve_date?>',
		'<?=$reserve_uuid?>',
		'<?=$promotion_idx?>'
	)
</script>