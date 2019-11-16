
<?php
    $config = require_once '../config/config.php';
    $votingName = $config['voting']['votingName'];      //name of voteSet
    $candidateList =  $config['voting']['candidateList']; //TODO check for unique values, maybe read from file
    $isVoter = $config['voting']['cookieName'];           // cookie is true after voting
    $isAlreadyVoted = isset( $_COOKIE[$isVoter] );        // true if already voted
    $isChoosed = isset( $_POST[$votingName] );           // true if smth choose maked
    $choosedCandidate = @$_POST[$votingName];
    $voteLifetime = $config['voting']['voteLifetime'];
    $fileName = $config['files']['resultsFileJSON'];

    $msg = '';
    $viewRoute = './viewVoting.php';

    if (isset( $_POST[$votingName.'__sbmt-btn'])) {
        $viewRoute = './viewChartPie.php';
        if ( !$isChoosed) {
            $msg = 'you need choose one of candidates';
            $viewRoute = './viewVoting.php';
        }
        if ($isAlreadyVoted) {
            $msg = 'you have voted before'; //TODO display time when may voting again
            $viewRoute = './viewChartPie.php';
        }
        if (!$msg){
            require_once('../src/controllers/JSONFileHandler.php');
            $voteHandler = new FileHandler($fileName, $candidateList);
            $voteHandler -> addVote($_POST[$votingName]);
        }

    }
        echo $msg;
        require_once($viewRoute);


?>
