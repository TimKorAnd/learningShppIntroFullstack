
<?php
    $config = require_once 'config.php';
    $voteSetName = $config['voting']['voteSetName']; //name of voteSet
    $candidateList =  $config['voting']['candidateList']; //TODO read from file

    if ( isset( $_POST[$voteSetName.'__sbmt-btn'] )  ) {
        $voted = @$_POST[$voteSetName];
        include_once('./ChartPie/viewChartPie.php');
    } else {
        include_once('./view.php');
    }
    //echo '<br/><a href="index.php">vote again</a>';
?>
