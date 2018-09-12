<?php
require("config/config.php");

//load the required classes
require("classes/route.php");
require("classes/basecontroller.php");  
require("classes/view.php");
require("classes/loader.php");

require 'models/database.php';
require 'models/Data.php';

require 'models/user.php';

// ---LANGUAGE I18N ---
require_once('helpers/gettext/gettext.inc');

define("DEFAULT_LOCALE", "ja");

error_reporting (E_ALL ^ E_NOTICE);
mb_internal_encoding('UTF-8');

$encoding = 'UTF-8';

$locale = (isset($_GET['lang']))? $_GET['lang'] : DEFAULT_LOCALE;

// gettext setup
T_setlocale(LC_ALL, $locale);
// Set the text domain as 'messages'
$domain = 'messages';
bindtextdomain($domain, './locale');
// bind_textdomain_codeset is supported only in PHP 4.2.0+
if (function_exists('bind_textdomain_codeset')) 
  bind_textdomain_codeset($domain, $encoding);
textdomain($domain);

date_default_timezone_set("Asia/Tokyo");

ob_start();
session_start();

$route = new Route();

/*
if ($route->getControllerName() == "menu") {
    $redirectTo = $route->url("menu", array('location' => $_SERVER["REQUEST_URI"]));
    header("Location: $redirectTo");
    exit();
}*/
function formatMoney($number) {
      $num = explode(".", $number); 
  while (true) { 
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $num[0]); 
        if ($replaced != $num[0]) { 
            $num[0] = $replaced; 
        } else { 
            break; 
        } 
    } 
    $number = implode(".", $num);
    return $number; 
}

//Check login
$currentUser = User::getCurrentUser();
if ($currentUser == null && $route->getControllerName() != "authenticate") {
    $redirectTo = $route->url("authenticate","login",array('location' => $_SERVER["REQUEST_URI"]));
    header("Location: $redirectTo");
    exit();
}

// $maintain_controler_arr = array("authenticate","company","department","user","category","employee","inquirymanager","release","termsmanager");
// $admin_controler_arr = array("authenticate","home","list","kpiregistration","kpiresult","importexport","department","user","employee","inquiry","versioninfo","terms");
// $member_controler_arr = array("authenticate","home","list","kpiregistration","kpiresult","importexport","user","employee","inquiry","versioninfo","terms");
// 
// $controler = $route->getControllerName();
// 
// if (User::getCurrentUser()->maintenance_flag == true){
//     
    // if(!in_array($route->getControllerName(), $maintain_controler_arr)){
        // $controler = "company";
    // }
// }
// elseif (User::getCurrentUser()->admin_flag == 1){
//     
    // if(!in_array($route->getControllerName(), $admin_controler_arr)){
        // $controler = "home";
    // }
// }
// 
// else{
    // $controler_arr = array("authenticate","home","list","kpiregistration","kpiresult","importexport","inquiry","versioninfo","terms");
    // if(!in_array($controler, $member_controler_arr)){
        // $controler = "home";
    // }
// }
// 

$member_controler_arr = array("authenticate","home","user","learning","testing","trialtesting","trialtestingdetail","admin");


$controler = $route->getControllerName();

if ($currentUser != null){
	if(!in_array($controler, $member_controler_arr)){
        $controler = "home";
    }
}
    
if ($controler != $route->getControllerName()){
    $redirectTo = $route->url($controler);
    header("Location: $redirectTo");
    exit();
}

$loader = new Loader($route); //create the loader object
$controller = $loader->createController(); //creates the requested controller object based on the 'controller' URL value
$controller->executeAction(); //execute the requested controller's requested method based on the 'action' URL value. Controller methods output a View.

?>