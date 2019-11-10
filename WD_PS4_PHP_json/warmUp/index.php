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
    $fileHandler = new JSONFileHandler();

    /*variables initialize*/
//$results['task1'] = $results['task2'] = 'check some box, enter values, and press Sum, please ';

    if (isset($_POST['task7__sbmt-btn'])) :
        require_once('./controllers/SessionCount.php');
        $sessionCount = new SessionCount();
        $sessionCount->sessionDestroy();
        //unset($sessionCount);
    endif;
    if (isset($_POST['doAdd'])) {
        //require_once('private/task12Calculate.php');
        include_once('controllers/Task12Controller.php');
        $task12Obj = new Task12Controller();
        $calcResults = $task12Obj->getResultsTask12();
        $_SESSION['task1-2']['calcResults'] = $calcResults; //for save static results
    } elseif (isset($_SESSION['task1-2'])) {
        $calcResults = $_SESSION['task1-2']['calcResults']; //restore static results
    }
    if (isset($_POST['task3__sbmt-btn'])) {
        $fileUploader = new FileUploader();
        $fileUploader->fileUpload();
        $fileHandler = new JSONFileHandler();
    }
    if (isset($_POST['task4__sbmt-btn']) || isset($_SESSION['task4__board'])) {
        require_once('./controllers/ChessBoarder.php');
        $chessBoard = new ChessBoarder();           //always fetch new results
    }
    if (isset($_POST['task5__sbmt-btn']) || isset($_SESSION['task5__digits'])) {
        require_once('./controllers/DigitSum.php');
        $digitSum = new DigitSum();                 //always fetch new results
    }
    if (isset($_POST['task6__sbmt-btn'])) {
        require_once('./controllers/ArrayProc.php');
        $arrayProc = new ArrayProc();
    }
    if (isset($_POST['task8__sbmt-btn'])) {
        require_once('./controllers/CharCount.php');
        $charCount = new CharCount();
    }


    include "./view.php";

    //TODO constants in namespace (?!) path to uploads in FileHandler