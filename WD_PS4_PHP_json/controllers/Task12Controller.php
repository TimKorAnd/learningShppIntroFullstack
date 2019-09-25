<?php

class Task12Controller
{
    /*task12 function calculation:
    1) посчитать сумму чисел от -1000 до 1000

    2) посчитать сумму чисел от -1000 до 1000, суммируя только числа которые заканчиваются на 2,3, и 7 */



    private const PATTERN_237 = "/[237]$/";
    private $results = [];
    private $from, $to;

    /**
     * Task12Controller constructor.
     * @param
     */
    public function __construct()
    {
        $this->results['task1'] = $this->results['task2'] = 'check some box, enter values, and press Sum, please ';
        $this->from = ($_REQUEST['task1-2']['from'] === '') ? 0 : intval($_REQUEST['task1-2']['from']);
        $this->to = ($_REQUEST['task1-2']['to'] === '') ? 0 : intval($_REQUEST['task1-2']['to']);
    }



    private function generateNextDigitInRangeByFilter(int $from = 0, int $to = 0, $cbFiltering)
    {
        for ($i = $from; $i <= $to; $i++) {
            if (Task12Controller::$cbFiltering($i))
                yield $i;
        }
    }

    private function sortAscendingLimits(int &$from, int &$to): void
    {
        if ($to < $from) [$from, $to] = [$to, $from];
        //echo "to is {$to}; from is {$from} <br>";
    }

    private function rangeSum(int $from = 0, int $to = 0, $cbFiltering): int
    {
        $this->sortAscendingLimits($from, $to);
        $sum = 0;
        //echo "to is {$to}; from is {$from} <br>";
        foreach ($this->generateNextDigitInRangeByFilter($from, $to, $cbFiltering) as $currentDigit) {
            $sum += $currentDigit;
        }
        return $sum;
    }

    /**
     * @param string $from
     * @param string $to
     * @param array $results
     */
    private function makeCalculation(int $from, int $to, array &$results): void
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
                    $results[$taskStatus] = "from {$from} to {$to} is " . $this->rangeSum($from, $to, $taskStatus);
                    //echo $results[$taskStatus];
                }
            }
        } catch (Exception $e) {
            var_dump($e);
        }
    }

    /*tasks functions for generators*/
    private function task1()
    {
        return true;
    }

    private function task2($e)
    {
        return preg_match(self::PATTERN_237, strval($e));
    }

 public function getResultsTask12(){

    /*$isTask1 = !empty($_REQUEST['task1-2']['taskStatus']['task1']);
    $isTask2 = !empty($_REQUEST['task1-2']['taskStatus']['task2']);*/
    if (empty($_REQUEST['task1-2']['taskStatus']['task1'])  &&
    empty($_REQUEST['task1-2']['taskStatus']['task2']))
    {
        $this->results['task1'] = $this->results['task2'] = 'check some box, please ';
    }
    else {
        $this->makeCalculation($this->from, $this->to, $this->results);
    }
    return $this->results;

 }
}