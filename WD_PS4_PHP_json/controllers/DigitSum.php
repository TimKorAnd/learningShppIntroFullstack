<?php


class DigitSum {
  private $digit = 0;

  public function __construct() {
    $this->digit = $_REQUEST['task5__digits'];
  }

  public function display() {

    function sum($v1, $v2) {
      return intval($v1) + intval($v2);
    }

    //echo array_reduce(str_split(strval($this->digit)),"sum",0);
    echo array_sum(str_split(strval($this->digit)));
  }
}