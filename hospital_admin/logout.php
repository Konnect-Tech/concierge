<?php

include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_default.php";

unset($_SESSION[$_SESSION_HOSPITAL_PREFIX . "code"], $_SESSION[$_SESSION_HOSPITAL_PREFIX . "name"]);

no_error_go("./login.php");