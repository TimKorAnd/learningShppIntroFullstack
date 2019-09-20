<?php
/*task12 function calculation:
1) посчитать сумму чисел от -1000 до 1000

2) посчитать сумму чисел от -1000 до 1000, суммируя только числа которые заканчиваются на 2,3, и 7 */
declare(strict_types = 1);
require_once "dumper.php";

define("PATTERN_237", "/[237]$/");

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
 * @param array $results
 */
function makeCalculation(int $from, int $to, array &$results): void
{
    //dumper($_REQUEST);
    //global $results;
    try {
        $from = intval($_REQUEST['task1-2']['from']);
        $to = intval($_REQUEST['task1-2']['to']);
        foreach ($_REQUEST['task1-2']['taskStatus'] as $taskStatus => $v) {
            /*dumper($taskStatus);
            echo $v;*/
            if ($v === '0') {
                $results[$taskStatus] = " not calculate - unchecked";
            } else {
                $results[$taskStatus] = "from {$from} to {$to} is " . rangeSum($from, $to, $taskStatus);
                //echo $results[$taskStatus];
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

$from = ($_REQUEST['task1-2']['from'] === '') ? 0 : intval($_REQUEST['task1-2']['from']);
$to = ($_REQUEST['task1-2']['to'] === '') ? 0 : intval($_REQUEST['task1-2']['to']);
$isTask1 = !empty($_REQUEST['task1-2']['taskStatus']['task1']);
$isTask2 = !empty($_REQUEST['task1-2']['taskStatus']['task2']);
if (!$isTask1 && !$isTask2) {
    $results['task1'] = $results['task2'] = 'check some box, please ';
} else
    makeCalculation($from, $to, $results);


