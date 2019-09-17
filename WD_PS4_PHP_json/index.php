<?php
/*controller*/
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

/**
 * @param string $from
 * @param string $to
 * @param array $result
 */
function makeCalculation(int $from, int $to, array $result): void
{
    dumper($_REQUEST);

    try {
        $from = intval($_REQUEST['task1-2']['from']);
        $to = intval($_REQUEST['task1-2']['to']);
        foreach ($_REQUEST['task1-2']['taskStatus'] as $taskStatus => $v) {
            dumper($taskStatus);
            echo $v;
            if ($v != '0') {
                $result[$taskStatus] = " " . rangeSum($from, $to, $taskStatus);
                echo $result[$taskStatus];
            }
        }
    } catch (Exception $e) {
        var_dump($e);
    }
}
/*tasks functions for generators*/
function task1 () {
    return true;
};
function task2($e) {
    return preg_match(PATTERN_237, strval($e));
};
//echo "controller start <br>";

$result = [];
//$result['task1'] = $result['task2'] = 'check some box, enter values, and press Sum, please ';
define("PATTERN_237", "/[237]$/");


if (!empty($_REQUEST['doAdd'])) {
    $from = ($_REQUEST['task1-2']['from'] === '') ? 0 : intval($_REQUEST['task1-2']['from']);
    $to = ($_REQUEST['task1-2']['to'] === '') ? 0 : intval($_REQUEST['task1-2']['to']);
    $isTask1 = !empty($_REQUEST['task1-2']['taskStatus']['task1']);
    $isTask2 = !empty($_REQUEST['task1-2']['taskStatus']['task2']);
    if (!$isTask1 && !$isTask2 ) {
        $result['task1'] = $result['task2'] = 'check some box, please ';
    } else
    makeCalculation($from, $to, $result);

} else {
    $result['task1'] = $result['task2'] = 'check some box, enter values, and press Sum, please ';
}
include "./view.php";
?>
