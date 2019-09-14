<?php
declare(strict_types = 1);

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
//echo "start<br>";
$from = 0;
$to = 0;
$result = 0;
define("PATTERN_237", "/[237]$/");
if (!empty($_REQUEST['doAdd'])) {
//if (true) {
//    var_dump($_REQUEST);
//    var_dump($_POST['task1-from']);
    $from = intval($_REQUEST['task1-from']);
    $to = intval($_REQUEST['task1-to']);
    try {
        $result = rangeSum($from, $to, function () {
            return true;
        });
        echo "Task1. Sum from  {$from} to {$to} is {$result}<br>\n";
        $result = rangeSum($from, $to, function ($e) {
            return preg_match(PATTERN_237, strval($e));
        });
        echo "Task2. Sum from  {$from} to {$to} is {$result})<br>\n";

        echo "stop </br>";
    } catch (Exception $e) {
        var_dump($e);
    }
}
include "view.php";
?>
