<?php

include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드

$total_param = trim(sqlfilter($_REQUEST['total_param']));
$idx = trim(sqlfilter($_REQUEST['idx']));
$hospitalId = trim(sqlfilter($_REQUEST['hospital']));
$location = trim(sqlfilter($_REQUEST['location']));
$procedure = trim(sqlfilter($_REQUEST['procedure']));
$is_promotion = trim(sqlfilter($_REQUEST['is_promotion']));
$amount = trim(sqlfilter($_REQUEST['amount']));
$hospital_info = trim(sqlfilter($_REQUEST['hospital_info']));
$major_procedures = trim(sqlfilter($_REQUEST['major_procedures']));
$operating_time = trim(sqlfilter($_REQUEST['operating_time']));
$hospital_pos = trim(sqlfilter($_REQUEST['hospital_pos']));

if(!$hospitalId){
	error_frame("병원을 선택해주세요.");
	exit;
}

if(!$is_promotion){
	error_frame("프로모션 여부를 선택해주세요.");
	exit;
}

$hospital = get_hospital($hospitalId);
$hospital_name = sqlfilter($hospital['name']);
$hospital_type = sqlfilter($hospital['medicalDepartment']);
$hospital_code = sqlfilter($hospital['code']);

$bbs_code = "promotion";
$_P_DIR_FILE = $_P_DIR_FILE.$bbs_code."/";
$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs_code."/";

$ingredients = [];
$ingredients[] = " `hospital` = '$hospital_name' ";
$ingredients[] = " `hospital_type` = '$hospital_type' ";
$ingredients[] = " `location` = '$location' ";
$ingredients[] = " `procedure` = '$procedure' ";
$ingredients[] = " `is_promotion` = '" . ($is_promotion == "Y" ? 1 : 0) . "' ";
$ingredients[] = " `amount` = '$amount' ";
$ingredients[] = " `hospital_info` = '$hospital_info' ";
$ingredients[] = " `major_procedures` = '$major_procedures' ";
$ingredients[] = " `operating_time` = '$operating_time' ";
$ingredients[] = " `hospital_pos` = '$hospital_pos' ";
$ingredients[] = " `hospital_id` = '$hospitalId' ";
$ingredients[] = " `hospital_code` = '$hospital_code' ";

if(isset($_FILES['banner_file']) && $_FILES['banner_file']['size'] > 0){
	$file_org = $_FILES['banner_file']['name'];
	$file_chg = uploadFile($_FILES, 'banner_file', $_FILES['banner_file'], $_P_DIR_FILE);

	$ingredients[] = " `banner_file_org` = '$file_org' ";
	$ingredients[] = " `banner_file_chg` = '$file_chg' ";
}

//if(isset($_FILES['procedure_file']) && $_FILES['procedure_file']['size'] > 0){
//	$file_org = $_FILES['procedure_file']['name'];
//	$file_chg = uploadFile($_FILES, 'procedure_file', $_FILES['procedure_file'], $_P_DIR_FILE);
//
//	$ingredients[] = " `procedure_file_org` = '$file_org' ";
//	$ingredients[] = " `procedure_file_chg` = '$file_chg' ";
//}

if(isset($_FILES['hospital_in_file']) && $_FILES['hospital_in_file']['size'] > 0){
	$file_org = $_FILES['hospital_in_file']['name'];
	$file_chg = uploadFile($_FILES, 'hospital_in_file', $_FILES['hospital_in_file'], $_P_DIR_FILE);

	$ingredients[] = " `hospital_in_file_org` = '$file_org' ";
	$ingredients[] = " `hospital_in_file_chg` = '$file_chg' ";
}

if(isset($_FILES['hospital_view_file']) && $_FILES['hospital_view_file']['size'] > 0){
	$file_org = $_FILES['hospital_view_file']['name'];
	$file_chg = uploadFile($_FILES, 'hospital_view_file', $_FILES['hospital_view_file'], $_P_DIR_FILE);

	$ingredients[] = " `hospital_view_file_org` = '$file_org' ";
	$ingredients[] = " `hospital_view_file_chg` = '$file_chg' ";
}

//if(isset($_FILES['hospital_review_file']) && $_FILES['hospital_review_file']['size'] > 0){
//	$file_org = $_FILES['hospital_review_file']['name'];
//	$file_chg = uploadFile($_FILES, 'hospital_review_file', $_FILES['hospital_review_file'], $_P_DIR_FILE);
//
//	$ingredients[] = " `hospital_review_file_org` = '$file_org' ";
//	$ingredients[] = " `hospital_review_file_chg` = '$file_chg' ";
//}

if(isset($_FILES['logo_file']) && $_FILES['logo_file']['size'] > 0){
	$file_org = $_FILES['logo_file']['name'];
	$file_chg = uploadFile($_FILES, 'logo_file', $_FILES['logo_file'], $_P_DIR_FILE);

	$ingredients[] = " `logo_file_org` = '$file_org' ";
	$ingredients[] = " `logo_file_chg` = '$file_chg' ";
}

$query = " UPDATE promotion_info SET " . implode(', ', $ingredients) . " WHERE `idx` = '$idx' ";
$result = mysqli_query($gconnet, $query);

$pressedQueries = [];
$procedure_state = false;
for($i = 0; $i < count($_FILES['procedure']['name']); $i ++){
	if($_FILES['procedure']['error'][$i] !== 0){
		continue;
	}

	$file_org = $_FILES['procedure']['name'][$i];
	$file_chg = uploadMultiFile('procedure', $_P_DIR_FILE, $i);

	if(!$procedure_state){
		$pressedQueries[] = " DELETE FROM promotion_image_list WHERE `type` = 'procedure' AND `promotion_idx` = '$idx' ";
		$procedure_state = true;
	}

	$query = " INSERT INTO promotion_image_list SET ";
	$query .= " `promotion_idx` = '$idx', ";
	$query .= " `type` = 'procedure', ";
	$query .= " `file_org` = '$file_org', ";
	$query .= " `file_chg` = '$file_chg' ";
	$pressedQueries[] = $query;
}

$review_state = false;
for($i = 0; $i < count($_FILES['review']['name']); $i ++){
	if($_FILES['review']['error'][$i] !== 0){
		continue;
	}

	$file_org = $_FILES['review']['name'][$i];
	$file_chg = uploadMultiFile('review', $_P_DIR_FILE, $i);

	if(!$review_state){
		$pressedQueries[] = " DELETE FROM promotion_image_list WHERE `type` = 'review' AND `promotion_idx` = '$idx' ";
		$review_state = true;
	}

	$query = " INSERT INTO promotion_image_list SET ";
	$query .= " `promotion_idx` = '$idx', ";
	$query .= " `type` = 'review', ";
	$query .= " `file_org` = '$file_org', ";
	$query .= " `file_chg` = '$file_chg' ";
	$pressedQueries[] = $query;
}

if(count($pressedQueries) > 0){
	$result = mysqli_multi_query($gconnet, implode('; ', $pressedQueries));
}

if($result){
	error_frame_go("프로모션 수정 작업이 정상적으로 완료되었습니다.", "./promotion_list.php?$total_param");
}else{
	error_frame("프로모션 수정 작업 도중에 알 수 없는 오류가 발생했습니다. ($gconnet->error)");
}