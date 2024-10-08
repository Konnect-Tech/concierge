<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));

$size = count($_REQUEST) - 1;

$bbs_code = "receipt";
$_P_DIR_FILE = $_P_DIR_FILE.$bbs_code."/";
$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs_code."/";

$pressedQueries = [];
for($i = 0; $i <= $size; $i ++){
	if(!isset($_FILES["upload-name-$i"])){
		continue;
	}
	if($_FILES["upload-name-$i"]['size'] <= 0){
		continue;
	}

	$file_org = $_FILES["upload-name-$i"]['name'];
	$file_chg = uploadFile($_FILES, "upload-name-$i", $_FILES["upload-name-$i"], $_P_DIR_FILE);

	$query = " INSERT INTO receipt_info SET ";
	$query .= " `member_idx` = '$member_idx', ";
	$query .= " `receipt_type` = '" . $_REQUEST["receipt_source_$i"] . "', ";
	$query .= " `file_org` = '$file_org', ";
	$query .= " `file_chg` = '$file_chg' ";

	$pressedQueries[] = $query;
}

if(count($pressedQueries) > 0){
	$result = mysqli_multi_query($gconnet, implode('; ', $pressedQueries));
	if($result){
		?>
		<script>
			parent.modalLayerOpen('<?=count($pressedQueries)?>')
		</script>
<?php
	}else{
		error_frame("구매영수증 업데이트 도중에 알 수 없는 오류가 발생했습니다.");
	}
}else{
	error_frame("구매영수증 업데이트 도중에 알 수 없는 오류가 발생했습니다.");
}
