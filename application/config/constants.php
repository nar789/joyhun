<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
	$http = "https";
}else{
	$http = "http";
}

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

$base_url	= $http."://".$_SERVER['HTTP_HOST'];
define('BASE_URL', $base_url);
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

define('IMG_DIR', $http.'://'.$_SERVER['HTTP_HOST'].'/images');
define('CSS_DIR', $http.'://'.$_SERVER['HTTP_HOST'].'/include/css');
define('JS_DIR', $http.'://'.$_SERVER['HTTP_HOST'].'/include/js');
define('INCLUDE_DIR', $http.'://'.$_SERVER['HTTP_HOST'].'/include');
define('HIGH_DIR', $http.'://'.$_SERVER['HTTP_HOST'].'/include/syntaxhighlighter');
define('HOST_DIR', $_SERVER['HTTP_HOST']);
define('BASEURL', $base_url);

define('BS_ADM_DIR', $http.'://'.$_SERVER['HTTP_HOST'].'/bootstrap/admin/assets');
define('ADMIN_DIR', $http.'://'.$_SERVER['HTTP_HOST'].'/admin/');
define('UPLOAD_DIR', $http.'://'.$_SERVER['HTTP_HOST'].'/upload');

define('DOC_ROOT', dirname(FCPATH)."/www");
define('DATA_ROOT', dirname(FCPATH).'/www/data');
define('INCLUDE_ROOT', dirname(FCPATH).'/www/include');
define('JS_ROOT', dirname(FCPATH).'/www/include/js');
define('CSS_ROOT', dirname(FCPATH).'/www/include/css');
define('VIEW_ROOT', dirname(FCPATH).'/www/'.APPPATH.'/views');

define('UPLOAD_ROOT', dirname(FCPATH).'/www/upload');

define('LIB_ROOT', dirname(FCPATH).'/www/application/libraries/');

define('APP_ROOT', "/app");
define('APP_ROOT_IOS', "/app_ios");

define('CACHE_TIME', 600);

//define('SITE_NAVER_ID', "dbccsjPoxKmFvuhJUNr6");
//define('SITE_NAVER_PW', "DfvZMKJmvA");
define('SITE_NAVER_ID', "ve6vphxt72");
define('SITE_NAVER_PW', "4xAXxKaGNoyBwF4lHX1d37BU3JoOOkQTbk36EasB");

/* End of file constants.php */
/* Location: ./application/config/constants.php */