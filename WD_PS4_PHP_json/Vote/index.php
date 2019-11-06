
<?php
    $voteSetName = 'voteSet'; //name of voted
    $candidateList = ['candidate1', 'candidate2', 'candidate3', 'four']; //TODO read from file

    if ( isset( $_POST[$voteSetName.'__sbmt-btn'] )  ) {
        $voted = @$_POST[$voteSetName];
        switch ($voted) {
            case null :
                echo 'choose any candidate and vote';
                include_once('./view.php');
                break;
            case '0':
                echo 'Первый';
                break;
            case '1' :
                echo 'второй';
                break;
            case '2' :
                echo 'тертий';
                break;
            case '3' :
                echo 'четвертый';
                break;
        }
    }
    else {
//        echo 'you have to vote';
        include_once('./view.php');
    }
    echo '<br/><a href="index.php">vote again</a>';
?>
