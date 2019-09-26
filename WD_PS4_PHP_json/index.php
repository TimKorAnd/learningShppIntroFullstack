<?php
declare(strict_types=1);
/*phpinfo();*/
require_once "dumper.php";
require_once ('./controllers/FileUploader.php');

/*dumper($_SERVER);*/
$calcResults = [];

require_once ('./controllers/FileHandler.php');
$fileHandler = new FileHandler();

/*variables initialize*/
//$results['task1'] = $results['task2'] = 'check some box, enter values, and press Sum, please ';

if (!empty($_REQUEST['doAdd'])) {
    //require_once('private/task12Calculate.php');
    include_once ('controllers/Task12Controller.php');
    $task12Obj = new Task12Controller();
    $calcResults = $task12Obj->getResultsTask12();
} elseif (!empty($_REQUEST['task3__sbmt-btn'])) {
    //include_once ('private/upload.php');
    //require_once ('./controllers/FileHandler.php');
    $fileUploader = new FileUploader();
    $fileUploader->fileUpload();
    $fileHandler = new FileHandler();
}

include "./view.php";

//TODO constants in namespace (?!) path to uploads in FileHandler