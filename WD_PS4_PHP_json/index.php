<?php
declare(strict_types = 1);

function generateNextDigitInRange(int $from = 0, int $to = 0) {
    for ($i = $from; $i <= $to; $i++)
        yield $i;
}

function ascendLimits(int &$from, int &$to): void {
    if ($to < $from) [$from, $to] = [$to, $from];
    //echo "to is {$to}; from is {$from} <br>";
}

function rangeSum (int $from = 0, int $to = 0): int {
    ascendLimits($from, $to);
    $sum = 0;
    //echo "to is {$to}; from is {$from} <br>";
    foreach (generateNextDigitInRange($from, $to) as $currentDigit) {
      $sum += $currentDigit;
    }
    return $sum;
}
echo "start<br>";
try {
    $result = rangeSum(1000,-1000);
    echo "sum is {$result} asasas";
    echo "dfsdfasdf </br>";
    echo "stop </br>";
} catch (\Exception $e){
  var_dump($e);
}


?>
