<?php


class FileHandler
{
    /**
     * FileHandler constructor.
     */
    private $results = [];
    public $testStr = "test class FileHandler";
    public function __construct()
    {
        $this->results = glob("uploads/*.*",GLOB_NOSORT);
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }

    public function displayFileList(){
        foreach ($this->results as $currentFileName){
            echo $currentFileName;
        }
    }

    public function __toString():string
    {
        return ''.join(' ',$this->results);
    }

}