<?php

ini_set("session.cache_expire", 60000); // 세션 유효시간 : 분 
ini_set("session.gc_maxlifetime", 86400); // 세션을 24시간 동안 유지
session_start();
date_default_timezone_set('Asia/Seoul');
#session_cache_limiter("private"); 
header("Pragma: no-cache");  
header("Cache-Control: no-cache,must-revalidate");
header('Content-Type: text/html; charset=UTF-8'); 

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR  | E_PARSE | E_USER_ERROR | E_USER_WARNING );
ini_set("display_errors", "1");

include_once $_SERVER["DOCUMENT_ROOT"]."/pro_inc/user_function.php"; // PHP 유저 함수 모음
include_once $_SERVER["DOCUMENT_ROOT"]."/pro_inc/konc_functions.php"; // 컨시어지 함수
include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/db_conn.php"; 

if(!isset($_SERVER["HTTPS"])) { 
	$inc_fdata_ctype = "http";
	$inc_fdata_domain = "http://".$_SERVER["HTTP_HOST"]."";
} else {
	$inc_fdata_ctype = "https";
	$inc_fdata_domain = "https://".$_SERVER["HTTP_HOST"]."";
}

// 첨부파일 저장 
$_P_DIR_FILE =  $_SERVER["DOCUMENT_ROOT"]."/upload_file/"; //게시판,자료 등에서 업로드하는 폴더가 저장되는 경로
$_P_DIR_WEB_FILE= "/upload_file/";

$_SESSION_DEFAULT_PREFIX = "default_bn_";
$_SESSION_ADMIN_PREFIX = "admin_bn_";
$_SESSION_HOSPITAL_PREFIX = "hospital_bn_";

$inc_fdata_url = $_SERVER['SCRIPT_NAME']."?".$_SERVER['QUERY_STRING'];		

$include_public_current_date = date("Y-m-d H:i:s");
$include_current_date = date("Y-m-d");
$include_current_month_s = date("Y-m")."-01";
$include_current_month_e = date("Y-m")."-31";
$include_current_time = date("Hi");

$_SITE_TITLE = "컨시어지 플랫폼";
$_SITE_ADMIN_TITLE = $_SITE_TITLE."_관리자";
