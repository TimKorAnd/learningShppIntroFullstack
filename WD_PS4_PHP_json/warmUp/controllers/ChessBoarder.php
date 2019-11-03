<?php


    class ChessBoarder
    {
        use ValueStorage;
        private $boardWidth = 0;
        private $boardHeight = 0;
        private $resultBoard = '';

        /**
         * ChessBoarder constructor.
         */
        public function __construct()
        {
            $this->boardWidth = isset($_POST['task4__board']['width']) ?
              $_POST['task4__board']['width'] : $_SESSION['task4__board']['width'];
            $this->boardHeight = isset($_POST['task4__board']['height']) ?
            $_POST['task4__board']['height'] : $_SESSION['task4__board']['height'];
            $this->saveValues('task4__board');
        }

        public function display()
        {
            for ($row = 0; $row < $this->boardHeight; $row++) {
                for ($col = 0; $col < $this->boardWidth; $col++) {
                    $className = 'white-cell ';
                    if (($row + $col) % 2 === 0) {
                        $className = 'black-cell ';
                    }
                    $this->resultBoard .= '<div class="' . $className . ' row">&nbsp&nbsp&nbsp&nbsp</div>';
                }
                $this->resultBoard .= '<div class="col"></div>';
            }
            echo $this->resultBoard;
        }

    }