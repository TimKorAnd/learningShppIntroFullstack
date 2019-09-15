<?php
declare(strict_types = 1);
require_once "dumper.php";

function generateNextDigitInRangeByFilter(int $from = 0, int $to = 0, $cbFiltering ) {
    for ($i = $from; $i <= $to; $i++) {
        if ($cbFiltering($i))
        yield $i;
    }
}

function sortAscendingLimits(int &$from, int &$to): void {
    if ($to < $from) [$from, $to] = [$to, $from];
    //echo "to is {$to}; from is {$from} <br>";
}

function rangeSum (int $from = 0, int $to = 0, $cbFiltering): int {
    sortAscendingLimits($from, $to);
    $sum = 0;
    //echo "to is {$to}; from is {$from} <br>";
    foreach (generateNextDigitInRangeByFilter($from, $to, $cbFiltering) as $currentDigit) {
      $sum += $currentDigit;
    }
    return $sum;
}
//echo "controller start <br>";
$from = 0;
$to = 0;
$result = "";

define("PATTERN_237", "/[237]$/");
/*array of different tasks functions*/
$taskFunctions = [
    ['task1'] => function () {
        return true;
    },
    ['task2'] => function ($e) {
        return preg_match(PATTERN_237, strval($e));
    }];

if (!empty($_REQUEST['doAdd'])) {
//if (true) {
    dumper($_REQUEST);

    $from = intval($_REQUEST['task1-2']['from']);
    $to = intval($_REQUEST['task1-2']['to']);
    try {
        foreach ($_REQUEST['task1-2']['taskStatus'] as $taskStatus) {
            var_dump($taskStatus);
            if ($taskStatus == '1')
                $result .= rangeSum($from, $to, $taskFunctions[$taskStatus]);
            //echo "Task1. Sum from  {$from} to {$to} is {$result}<br>\n";


            /*$result = rangeSum($from, $to, function ($e) {
                return preg_match(PATTERN_237, strval($e));
            });
            echo "Task2. Sum from  {$from} to {$to} is {$result})<br>\n";*/


            echo "stop </br>";
        }
    } catch (Exception $e) {
        var_dump($e);
    }
}
include "./view.php";
?>
