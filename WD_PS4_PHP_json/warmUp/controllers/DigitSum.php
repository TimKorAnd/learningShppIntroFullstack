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

            //echo array_reduce(str_split(strval($this->digit)),"sum",0);
            echo array_sum(str_split(strval($this->digit)));
        }
    }