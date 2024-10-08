<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";
include("../_inc/head.php");

$email = trim(sqlfilter($_REQUEST['email']));
$passport_num = trim(sqlfilter($_REQUEST['passport_num']));

$valid_query = " SELECT idx FROM member_info WHERE `user_id` = '$email' OR `passport_num` = '$passport_num' ";
$valid_result = mysqli_query($gconnet, $valid_query);
if($valid_result->num_rows){
	error_frame("我已经注册了一个帐户");
	exit;
}

$email = trim(sqlfilter($_REQUEST['email']));
$password = trim(sqlfilter($_REQUEST['password']));
$user_last_name = strtoupper(trim(sqlfilter($_REQUEST['user_last_name'])));
$user_first_name = strtoupper(trim(sqlfilter($_REQUEST['user_first_name'])));
$birthday = trim(sqlfilter($_REQUEST['birthday']));
$gender = trim(sqlfilter($_REQUEST['gender']));
$phone_code = trim(sqlfilter($_REQUEST['phone_code']));
$phone_num = trim(sqlfilter($_REQUEST['phone_num']));
$wechat_id = trim(sqlfilter($_REQUEST['wechat_id']));
$shilla_id = trim(sqlfilter($_REQUEST['shilla_id']));
$passport_last_name = trim(sqlfilter($_REQUEST['passport_last_name']));
$passport_first_name = trim(sqlfilter($_REQUEST['passport_first_name']));
$passport_num = trim(sqlfilter($_REQUEST['passport_num']));
$passport_expire_date = trim(sqlfilter($_REQUEST['passport_expire_date']));
$data_type = trim(sqlfilter($_REQUEST['data_type']));

if(strlen($phone_num) < 13){
	error_frame("请输入所有手机号码");
	exit;
}

$member_code = strtoupper(randomChar(2)) . random_int(1111, 9999);

$query = " INSERT INTO member_info SET ";
$query .= " `member_type` = 'GEN', ";
$query .= " `member_code` = '$member_code', ";
$query .= " `user_id` = '$email', ";
$query .= " `user_pwd` = '" . password_hash($password, PASSWORD_DEFAULT) . "', ";
$query .= " `user_name` = '$user_last_name $user_first_name', ";
$query .= " `user_last_name` = '$user_last_name', ";
$query .= " `user_first_name` = '$user_first_name', ";
$query .= " `birthday` = '$birthday', ";
$query .= " `gender` = '$gender', ";
$query .= " `phone_code` = '$phone_code', ";
$query .= " `phone_num` = '$phone_num', ";
$query .= " `wechat_id` = '$wechat_id', ";
$query .= " `shilla_id` = '$shilla_id', ";
$query .= " `passport_last_name` = '$passport_last_name', ";
$query .= " `passport_first_name` = '$passport_first_name', ";
$query .= " `passport_num` = '$passport_num', ";
$query .= " `passport_expire_date` = '$passport_expire_date', ";
$query .= " `data_type` = '$data_type', ";
$query .= " `wdate` = NOW() ";
$result = mysqli_query($gconnet, $query);
if($result){
	$_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"] = $gconnet->insert_id;
	$_SESSION[$_SESSION_DEFAULT_PREFIX . "name"] = $user_last_name . " " . $user_first_name;
	$_SESSION[$_SESSION_DEFAULT_PREFIX . "id"] = $email;
	$_SESSION[$_SESSION_DEFAULT_PREFIX . "code"] = $member_code;

	$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];

	echo("
				<script type='text/javascript'>
					var request = $.ajax({
						type: 'POST',
						data: {externalId:'$shilla_id' ,memberId:'$member_idx', countryCode:'', name:'$user_first_name $user_last_name', passportNumber:'$passport_num'},
						url: 'https://concierge.fourdpocket.com/api/v1/voucherin/signInVoucher',
						contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
						dataType: 'json',
						success:function(result){
							console.log(result)
						}
					});
				</script>
	");

	echo("
		<script type='text/javascript'>
		let str='$birthday';
		let replaced_str1 = str.replace(/-/ig, '');
		var sendData = {
			birth:replaced_str1, 
			conciergeId:'$member_idx', 
			countryCode:'', 
			name:'$user_first_name $user_last_name', 
			passportNumber:'$passport_num', 
			password:'$password', 
			phone:'$phone_num', 
			sex:'T'
		}
		var request = $.ajax({
			type: 'POST',
			data: JSON.stringify(sendData),
			url: 'https://concierge.fourdpocket.com/api/v1/auth/signUp',
			contentType: 'application/json; charset=UTF-8',
			dataType: 'json',
			success:function(result){
				console.log(result)
			}
		});
	</script>
	");
	
	error_frame_go("会员注册已成功完成。", "../");
}else{
	error_frame("会员注册期间发生未知错误。");
}