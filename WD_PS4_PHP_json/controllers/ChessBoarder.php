<?php


class ChessBoarder
{
  private $boardWidth = 0;
  private $boardHeight = 0;
  private $resultBoard ='';

  /**
   * ChessBoarder constructor.
   */
  public function __construct()
  {
    $this->boardWidth = $_REQUEST['task4__boardWidth'];
    $this->boardHeight = $_REQUEST['task4__boardHeight'];
  }

  public function display()
  {
    for ($row = 0; $row < $this->boardHeight; $row++ ){
      for ($col = 0; $col < $this->boardWidth; $col++ ){
        $className = 'white-cell ';
        if (($row + $col) % 2 === 0) {
          $className = 'black-cell ';
        }
        $this->resultBoard .= '<div class="'.$className.' row">&nbsp&nbsp&nbsp&nbsp</div>';
      }
      $this->resultBoard .= '<div class="col"></div>';
    }
    echo $this->resultBoard;
  }

}