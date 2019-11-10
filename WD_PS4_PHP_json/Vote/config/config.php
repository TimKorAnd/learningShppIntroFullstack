<?php
return [
    'voting' => [
        'votingName' => 'votingForCandidates', //name of voting,
        'cookieName' => 'isVoter', // generate smth safe/hash/personal ?
        'voteLifetime' => 60, //TODO change for '60*60*24'
        'candidateList' => ['zerocandidate','candidate1', 'candidate2', 'candidate3', 'four']

    ],
    'files' => [
        'resultsFileJSON' => '../src/voteresults.json',
        'username' => 'sender@test.ru',
        'password' => 'Vbs3Hts42sdh',
        'port' => '465',
        'encryption' => 'SSL'
    ]
];