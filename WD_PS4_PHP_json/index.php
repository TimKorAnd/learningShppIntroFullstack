<?php
declare(strict_types=1);
require_once "dumper.php";
/*all errors display*/
ini_set('display_errors','1');
error_reporting(E_ALL);
/**/
define('ROOT',__DIR__ );
require_once(ROOT.'/components/Router.php');

$router = new Router();
$router->run();
/*dumper($_SERVER);*/

/*
if (!empty($_REQUEST['doAdd'])) {
    require_once('private/task12.php');
}*/
include "./view.php";
?>
