<?php


    class WarmUpFileHandler
    {
        private static $kibiUnits = 1024; //https://en.m.wikipedia.org/wiki/Kibibyte
        private $results = [];

        /**
         * WarmUpFileHandler constructor.
         */
        public function __construct()
        {
            $this->results = glob("uploads/*.*", GLOB_NOSORT);
        }

        /**
         * @param $fileName
         * @return size in some units
         */
        public function getFileSize($fileName): string
        {
            $sizeKb = filesize($fileName);
            $i = 0;
            $sizeUnits = [' byte', ' KiB', ' MiB', ' GiB', ' TiB', ' PiB', ' EiB', ' ZiB', ' YiB'];

            while ($sizeKb / self::$kibiUnits >= 1) {
                $i++;
                $sizeKb /= self::$kibiUnits;
            }
            return round($sizeKb, 1) . $sizeUnits[$i];
        }

        public function displayFileList()
        {
            echo "<table id='" . __CLASS__ . "__table' class='" . __CLASS__ . "__table' style='width=100%; border: 1px solid black'>";
            echo "<tr><th>Filenames stored in (" . dirname(__FILE__, 2) . "/uploads/..)</th><th>file size</th><th>img file preview</th></tr>";
            foreach ($this->results as $currentFileName) {
                echo "<tr><td><a href=" . $currentFileName . " download>"
                  . trim(pathinfo($currentFileName, PATHINFO_FILENAME)) . "</a></td>";
                echo "<td>[" . $this->getFileSize($currentFileName) . "]</td>";
                if (getimagesize($currentFileName)) {
                    echo "<td><img src='$currentFileName' height='42' ></td>";
                } else {
                    echo "<td>no preview</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }

        public function __toString(): string
        {
            return '' . join(' ', $this->results);
        }

    }