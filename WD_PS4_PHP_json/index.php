<?php
    declare(strict_types=1);
    define('SESSION_NAME', 'timkorPS4_WarmUp');
    /*phpinfo();*/
    session_name(SESSION_NAME);
    session_start();
    require_once "dumper.php";
    require_once('./controllers/FileUploader.php');
    require_once('./controllers/ValueStorage.php'); // for inputs value save in $_SESSION

    /*dumper($_SERVER);*/
    $calcResults = [];

    require_once('./controllers/FileHandler.php');
    $fileHandler = new FileHandler();

    /*variables initialize*/
//$results['task1'] = $results['task2'] = 'check some box, enter values, and press Sum, please ';

    if (!empty($_POST['task7__sbmt-btn'])) {
        require_once('./controllers/SessionCount.php');
        $sessionCount = new SessionCount();
        $sessionCount->sessionDestroy();
        //unset($sessionCount);
    }
    if (!empty($_POST['doAdd']) || isset($_SESSION['task1-2'])) {
        //require_once('private/task12Calculate.php');
        include_once('controllers/Task12Controller.php');
        $task12Obj = new Task12Controller();
        $calcResults = $task12Obj->getResultsTask12();
    }
    if (!empty($_POST['task3__sbmt-btn'])) {
        //include_once ('private/upload.php');
        //require_once ('./controllers/FileHandler.php');
        $fileUploader = new FileUploader();
        $fileUploader->fileUpload();
        $fileHandler = new FileHandler();
    }
    if (!empty($_POST['task4__sbmt-btn']) || isset($_SESSION['task4__board'])) {
        require_once('./controllers/ChessBoarder.php');
        $chessBoard = new ChessBoarder();
    }
    if (!empty($_POST['task5__sbmt-btn']) || isset($_SESSION['task5__digits'])) {
        require_once('./controllers/DigitSum.php');
        $digitSum = new DigitSum();
    }
    if (!empty($_POST['task6__sbmt-btn'])) {
        require_once('./controllers/ArrayProc.php');
        $arrayProc = new ArrayProc();
    }


    include "./view.php";

    //TODO constants in namespace (?!) path to uploads in FileHandler