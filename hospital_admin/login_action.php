<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$code = trim(sqlfilter($_REQUEST['code']));
if(!$code){
	error_frame("코드를 입력해주세요.");
	exit;
}

$hospitals = get_hospitals('code', 'name', static function(array $data): array{ return ["code" => $data['_doc']["code"], "name" => $data['_doc']['name']]; });
if(!isset($hospitals[$code])){
	?>
	<script>
        parent.appear_preset();
	</script>
	<?php
	exit;
}

$_SESSION[$_SESSION_HOSPITAL_PREFIX . "code"] = $code;
$_SESSION[$_SESSION_HOSPITAL_PREFIX . "name"] = $hospitals[$code];

frame_go("./add_surgery.php");