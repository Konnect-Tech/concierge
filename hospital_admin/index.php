<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

if(isset($_SESSION[$_SESSION_HOSPITAL_PREFIX . "code"])){
	no_error_go("./calculate.php");
}else{
	no_error_go("./login.php");
}