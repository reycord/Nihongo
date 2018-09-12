<?php
require("config/config.php");

//load the required classes
require("classes/route.php");
require("classes/basecontroller.php");  
require("classes/view.php");
require("classes/loader.php");

require 'models/database.php';
require 'models/Data.php';

// ---LANGUAGE I18N ---
require_once('helpers/gettext/gettext.inc');

define("DEFAULT_LOCALE", "ja");

//error_reporting (0);
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

try {
	
	//merge data input to $_POST
	$_POST = array_merge($_POST, (array)json_decode(file_get_contents("php://input")));

	$route = new Route(array( 'json' => true));
    
	$loader = new Loader($route); //create the loader object
	$controller = $loader->createController(); //creates the requested controller object based on the 'controller' URL value
	$controller->executeAction(); //execute the requested controller's requested method based on the 'action' URL value. Controller methods output a View.
} catch (Exception $e) {
	 $res = array('success' => false,
        'code' => ERR_SYSTEM,
        'message' => __('System error'),
    );

    echo json_encode($res);

    return;
}

?>