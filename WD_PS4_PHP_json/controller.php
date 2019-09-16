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
$from = '';
$to = '';
$result = [];

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

    /*$from = !empty($_REQUEST['task1-2']['from']) ? intval($_REQUEST['task1-2']['from']) : '';
    $to = !empty($_REQUEST['task1-2']['to']) ? intval($_REQUEST['task1-2']['to']) : '';*/
    if ($from  && $to) {

        try {
            $from = intval($_REQUEST['task1-2']['from']);
            $to = intval($_REQUEST['task1-2']['to']);
            foreach ($_REQUEST['task1-2']['taskStatus'] as $taskStatus => $v) {
                dumper($taskStatus);
                echo $v;
                if ($v != '0')
                    $result[$taskStatus] = " " . rangeSum($from, $to, $taskStatus);
            }
        } catch (Exception $e) {
            var_dump($e);
        }
    } else {
        if ($_REQUEST['task1-2']['from'])
        $result['task1'] = ($from === '') ? "Enter to, please": "Enter from, please";
        $result['task1'] = empty($_REQUEST['task1-2']['taskStatus']['task1']) ? "" : $result["task1"];
        $result['task2'] = ($to === '') ? "Enter from, please": "Enter to, please";
        $result['task2'] = empty($_REQUEST['task1-2']['taskStatus']['task2']) ? "" : $result["task2"];
    }

}
include "./view.php";
?>
