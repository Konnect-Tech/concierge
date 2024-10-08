<?php
mysqli_close($gconnet);

if(!isset($board_width)){
	$board_width = 1;
}
if(!isset($board_height)){
	$board_height = 1;
}

if(true){
	?>
<iframe name="_fra_admin" width="<?=$board_width?>" height="<?=$board_height?>"></iframe>
<iframe name="_fra_admin2" width="<?=$board_width?>" height="<?=$board_height?>"></iframe>
<div id="CalendarLayer" style="display:none; width:172px; height:250px; z-index:100;">
    <iframe name="CalendarFrame" src="/pro_inc/include_calendar.php" width="172" height="250" border="0" frameborder="0"
        scrolling="no"></iframe>
</div>

<?php } ?>