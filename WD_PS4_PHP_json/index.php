<?php
declare(strict_types=1);
require_once "dumper.php";

/*dumper($_SERVER);*/
$results = [];

/*variables initialize*/
$results['task1'] = $results['task2'] = 'check some box, enter values, and press Sum, please ';

if (!empty($_REQUEST['doAdd'])) {
    //require_once('private/task12.php');
    include_once ('controllers/Task12Controller.php');
    $task12Obj = new Task12Controller();
    $task12Obj->actionTask12();
}

include "./view.php";
?>
