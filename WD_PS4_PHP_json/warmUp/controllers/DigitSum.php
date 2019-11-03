<?php


    class DigitSum
    {
        use ValueStorage;
        private $digit = 0;

        public function __construct()
        {
            $this->digit = isset($_POST['task5__digits']) ?
              $_POST['task5__digits'][0] : $_SESSION['task5__digits'][0];
            $this->saveValues('task5__digits');
        }

        public function display()
        {

            function sum($v1, $v2)
            {
                return intval($v1) + intval($v2);
            }

            //echo array_reduce(str_split(strval($this->digit)),"sum",0);
            echo array_sum(str_split(strval($this->digit)));
        }
    }