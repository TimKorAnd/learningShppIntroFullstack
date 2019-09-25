<?php
declare(strict_types=1);
require_once "dumper.php";

/*dumper($_SERVER);*/
$calcResults = [];

/*variables initialize*/
//$results['task1'] = $results['task2'] = 'check some box, enter values, and press Sum, please ';

if (!empty($_REQUEST['doAdd'])) {
    //require_once('private/task12Calculate.php');
    include_once ('controllers/Task12Controller.php');
    $task12Obj = new Task12Controller();
    $calcResults = $task12Obj->actionTask12();
} elseif (!empty($_REQUEST['task3__sbmt-btn'])) {
  include_once ('private/upload.php');
}

include "./view.php";

