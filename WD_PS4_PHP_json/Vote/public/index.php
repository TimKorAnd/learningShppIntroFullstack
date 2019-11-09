
<?php
    $config = require_once '../config/config.php';
    $voteSetName = $config['voting']['voteSetName'];      //name of voteSet
    $candidateList =  $config['voting']['candidateList']; //TODO read from file
    $isVoter = $config['voting']['cookieName'];           // cookie is true after voting
    $isAlreadyVoted = isset( $_COOKIE[$isVoter] );        // true if already voted
    $isChoosed = isset( $_POST[$voteSetName] );           // true if smth choose maked
    $voteLifetime = $config['voting']['voteLifetime'];
    $fileName = $config['files']['resultsFileJSON'];

    $msg = '';
    $viewRoute = './viewVoting.php';

    if (isset( $_POST[$voteSetName.'__sbmt-btn'])) {
        $viewRoute = './viewChartPie.php';
        if ( !$isChoosed) {
            $msg = 'you need choose one of candidates';
            $viewRoute = './viewVoting.php';
        }
        if ($isAlreadyVoted) {
            $msg = 'your vote is done earlier '; //TODO display time when may voting again
            $viewRoute = './viewChartPie.php';
        }

    }
        if (!$msg){
            require_once('../src/controllers/FileHandler.php');
            $voteResults = new FileHandler($fileName);
            $voteResults =
        }
        echo $msg;
        include_once($viewRoute);



?>
