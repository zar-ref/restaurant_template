<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

//applicatiosn settings
define("SITE_PATH" , "http://localhost/_ANGULAR_PHP/"); //main site path
define("APP_PATH" , str_replace ("\\" , "/" ,  dirname(__FILE__) . "/"));
define("SITE_RESOURCES" , "http://localhost/_STEFAN_MVC/resources/");
define("APP_RESOURCES" , "http://localhost/_STEFAN_MVC/app/resources/");
define("SITE_CSS" , "http://localhost/_STEFAN_MVC/resources//css/style.css");
ini_set("default_charset", "UTF-8");
header("Content-type: text/html; charset=utf8");


echo APP_PATH;

//database settings
$server = "localhost";
$user = "root";
$pass = "";
$db = "fp_cms";

///connect to database

$Database = new mysqli($server , $user , $pass , $db);

$Database->set_charset('utf8');
$Database->query('SET scan OFF;');
//error repoerting

mysqli_report(MYSQLI_REPORT_ERROR);


//create flightpath core object
require_once(APP_PATH . "core/core.php");

$FP = new FlightPath_Core($server , $user , $pass , $db);



// strip slashes
if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value)
    {
        $value = is_array($value) ?
                    array_map('stripslashes_deep', $value) :
                    stripslashes($value);

        return $value;
    }

    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}
