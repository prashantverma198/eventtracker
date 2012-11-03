<?php
/**
 * Copyright (c) 2012 AD2C INDIA PVT. LTD
 *	
 *
 * @package       AD2CAMPAIGN
 * @copyright     AD2C INDIA PVT. LTD
 * @author        Alok Pabalkar <alok@ad2c.co>
 * @license       Proprietary
 * @Description   ad2campaign Configuration File
 * 
 */

session_start();
error_reporting(E_ERROR); //PRODUCTION
$_SESSION['appName'] = "ad2campaign";
$a = "Prashant";
define('__ROOT__', str_replace('\\','/',(((dirname(dirname(__FILE__))))))); 
define("__COREAPI__", __ROOT__."/coreApi");

include_once('common/class.database.php');
include_once('common/tablenames.php');
include_once('common/messages.php');
include_once('common/utility.php');

define("MYSQL_HOST", 'localhost');
define("MYSQL_USER",  'root');
define("MYSQL_PASSWORD", '');
define("MYSQL_DB_SCHEMA", 'mobimast_eventtracker');



date_default_timezone_set('Asia/Calcutta');
?>