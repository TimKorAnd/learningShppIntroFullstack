<?php

    require_once('./index.php');
    setcookie($isVoter,'true', time() + $voteLifetime);
    echo 'there will pie chart display for'.'<br/>';
    echo $choosedCandidate.'<br/>';
    //print_r();