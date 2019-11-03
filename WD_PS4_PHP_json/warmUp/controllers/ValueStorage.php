<?php


    /**
     * Trait ValueStorage - save inputs values into SESSION
     */
    trait ValueStorage
    {
        /**
         * @param $valueName - inputs (first?!) name
         */
        public function saveValues($valueName)
        {
            if (isset($_POST[$valueName])) {
                foreach ($_POST[$valueName] as $k => $v) {
                    $_SESSION[$valueName][$k] = $v;
                }
            }
        }
    }