<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

$member_idx = trim(sqlfilter($_REQUEST['member_idx']));

$query = " UPDATE member_info SET ";
$query .= " `is_del` = '1' ";
$query .= " WHERE `idx` = '$member_idx' ";
$result = mysqli_query($gconnet, $query);
if($result){
	?>
	<script>
		parent.modalLayerOpen()
	</script>
<?php
}