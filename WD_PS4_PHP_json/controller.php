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
/*tasks functions*/
    function task1 () {
        return true;
    };
    function task2($e) {
        return preg_match(PATTERN_237, strval($e));
    };

if (!empty($_REQUEST['doAdd'])) {
//if (true) {
    dumper($_REQUEST);

    $from = intval($_REQUEST['task1-2']['from']);
    $to = intval($_REQUEST['task1-2']['to']);
    try {
        foreach ($_REQUEST['task1-2']['taskStatus'] as $taskStatus => $v) {
            dumper($taskStatus);
            echo $v;
            if ($v != '0')
                $result .= rangeSum($from, $to, $taskStatus)." ";
        }
    } catch (Exception $e) {
        var_dump($e);
    }
}
include "./view.php";
?>
