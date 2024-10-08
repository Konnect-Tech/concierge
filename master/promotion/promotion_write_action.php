<?php

include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드

$total_param = trim(sqlfilter($_REQUEST['total_param']));
$hospitalId = trim(sqlfilter($_REQUEST['hospital']));
$location = trim(sqlfilter($_REQUEST['location']));
$procedure = trim(sqlfilter($_REQUEST['procedure']));
$is_promotion = trim(sqlfilter($_REQUEST['is_promotion']));
$amount = trim(sqlfilter($_REQUEST['amount']));
$hospital_info = trim(sqlfilter($_REQUEST['hospital_info']));
$major_procedures = trim(sqlfilter($_REQUEST['major_procedures']));
$operating_time = trim(sqlfilter($_REQUEST['operating_time']));
$hospital_pos = trim(sqlfilter($_REQUEST['hospital_pos']));

//if(!isset($_FILES['procedure_file']) || $_FILES['procedure_file']['size'] <= 0){
//	error_frame("시술 상세 이미지 파일을 업로드 해주세요.");
//	exit;
//}

if(!isset($_FILES['hospital_in_file']) || $_FILES['hospital_in_file']['size'] <= 0){
	error_frame("병원 내부 이미지 파일을 업로드 해주세요.");
	exit;
}

if(!isset($_FILES['hospital_view_file']) || $_FILES['hospital_view_file']['size'] <= 0){
	error_frame("병원 전경 이미지 파일을 업로드 해주세요.");
	exit;
}

//if(!isset($_FILES['hospital_review_file']) || $_FILES['hospital_review_file']['size'] <= 0){
//	error_frame("병원 후기 이미지 파일을 업로드 해주세요.");
//	exit;
//}

if(!isset($_FILES['banner_file']) || $_FILES['banner_file']['size'] <= 0){
	error_frame("병원 배너 이미지 파일을 업로드 해주세요.");
	exit;
}

if(!isset($_FILES['logo_file']) || $_FILES['logo_file']['size'] <= 0){
	error_frame("병원 로고 이미지 파일을 업로드 해주세요.");
	exit;
}

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

$code = generate_auth_key('promotion_info', 'P');

$query = " INSERT INTO promotion_info SET ";
$query .= " `code` = '$code', ";
$query .= " `hospital` = '$hospital_name', ";
$query .= " `hospital_type` = '$hospital_type', ";
$query .= " `location` = '$location', ";
$query .= " `procedure` = '$procedure', ";
$query .= " `is_promotion` = '" . ($is_promotion == "Y" ? 1 : 0) . "', ";
$query .= " `amount` = '$amount', ";
$query .= " `hospital_pos` = '$hospital_pos', ";
$query .= " `hospital_id` = '$hospitalId', ";
$query .= " `hospital_code` = '$hospital_code', ";

//$procedure_file_org = $_FILES['procedure_file']['name'];
//$procedure_file_chg = uploadFile($_FILES, 'procedure_file', $_FILES['procedure_file'], $_P_DIR_FILE);
//
//$query .= " `procedure_file_org` = '$procedure_file_org', ";
//$query .= " `procedure_file_chg` = '$procedure_file_chg', ";

$query .= " `hospital_info` = '$hospital_info', ";
$query .= " `major_procedures` = '$major_procedures', ";
$query .= " `operating_time` = '$operating_time', ";

$banner_file_org = $_FILES['banner_file']['name'];
$banner_file_chg = uploadFile($_FILES, 'banner_file', $_FILES['banner_file'], $_P_DIR_FILE);

$query .= " `banner_file_org` = '$banner_file_org', ";
$query .= " `banner_file_chg` = '$banner_file_chg', ";

$hospital_in_file_org = $_FILES['hospital_in_file']['name'];
$hospital_in_file_chg = uploadFile($_FILES, 'hospital_in_file', $_FILES['hospital_in_file'], $_P_DIR_FILE);

$query .= " `hospital_in_file_org` = '$hospital_in_file_org', ";
$query .= " `hospital_in_file_chg` = '$hospital_in_file_chg', ";

$hospital_view_file_org = $_FILES['hospital_view_file']['name'];
$hospital_view_file_chg = uploadFile($_FILES, 'hospital_view_file', $_FILES['hospital_view_file'], $_P_DIR_FILE);

$query .= " `hospital_view_file_org` = '$hospital_view_file_org', ";
$query .= " `hospital_view_file_chg` = '$hospital_view_file_chg', ";

//$hospital_review_file_org = $_FILES['hospital_review_file']['name'];
//$hospital_review_file_chg = uploadFile($_FILES, 'hospital_review_file', $_FILES['hospital_review_file'], $_P_DIR_FILE);
//
//$query .= " `hospital_review_file_org` = '$hospital_review_file_org', ";
//$query .= " `hospital_review_file_chg` = '$hospital_review_file_chg', ";

$logo_file_org = $_FILES['logo_file']['name'];
$logo_file_chg = uploadFile($_FILES, 'logo_file', $_FILES['logo_file'], $_P_DIR_FILE);

$query .= " `logo_file_org` = '$logo_file_org', ";
$query .= " `logo_file_chg` = '$logo_file_chg', ";

$query .= " `wdate` = NOW() ";
$result = mysqli_query($gconnet, $query);

$promotion_idx = $gconnet->insert_id;

$pressedQueries = [];
for($i = 0; $i < count($_FILES['procedure']['name']); $i ++){
	if($_FILES['procedure']['error'][$i] !== 0){
		continue;
	}

	$file_org = $_FILES['procedure']['name'][$i];
	$file_chg = uploadMultiFile('procedure', $_P_DIR_FILE, $i);

	$query = " INSERT INTO promotion_image_list SET ";
	$query .= " `promotion_idx` = '$promotion_idx', ";
	$query .= " `type` = 'procedure', ";
	$query .= " `file_org` = '$file_org', ";
	$query .= " `file_chg` = '$file_chg' ";
	$pressedQueries[] = $query;
}

for($i = 0; $i < count($_FILES['review']['name']); $i ++){
	if($_FILES['review']['error'][$i] !== 0){
		continue;
	}

	$file_org = $_FILES['review']['name'][$i];
	$file_chg = uploadMultiFile('review', $_P_DIR_FILE, $i);

	$query = " INSERT INTO promotion_image_list SET ";
	$query .= " `promotion_idx` = '$promotion_idx', ";
	$query .= " `type` = 'review', ";
	$query .= " `file_org` = '$file_org', ";
	$query .= " `file_chg` = '$file_chg' ";
	$pressedQueries[] = $query;
}

if(count($pressedQueries) > 0){
	$result = mysqli_multi_query($gconnet, implode('; ', $pressedQueries));
}

if($result){
	error_frame_go("프로모션 등록 작업이 정상적으로 완료되었습니다.", "./promotion_list.php?$total_param");
}else{
	var_dump($gconnet->error);
	error_frame("프로모션 등록 작업 도중에 알 수 없는 오류가 발생했습니다.");
}