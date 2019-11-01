<?php


class ArrayProc
{
  private $arr =[];
  private const arrLength = 100;
  private const maxNum = 10;

  public function __construct()
  {
    for ($i = 0; $i < self::arrLength; $i++){
      $this->arr[] = random_int(1,self::maxNum);
    }
  }

  public function display() {
    print_r($this->arr);
    echo '<br/>';
    print_r($this->arr = array_unique($this->arr));
    echo '<br/>';
    sort($this->arr );
    print_r($this->arr);
    echo '<br/>';
    $this->arr = array_reverse($this->arr);
    print_r($this->arr);
    echo '<br/>';
    $this->arr = array_map(function ($v){return $v * 2;},$this->arr);
    print_r($this->arr);

  }
}