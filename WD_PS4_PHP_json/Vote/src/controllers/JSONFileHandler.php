<?php


class JSONFileHandler
{
    private $results = [];
    private $fileName;
    private $candidateList;

    /**
     * FileHandler constructor.
     * @param $fileName
     * @param $candidateList
     */
    public function __construct($fileName, $candidateList)
    {
        $this->fileName = $fileName;
        $this->candidateList = $candidateList;
        $this->results = $this->getDataFromJSONFile();


    }

    public function getDataFromJSONFile()
    {
        $results = json_decode(file_get_contents($this->fileName),TRUE);
        if (empty($results)){
            $results = array_flip($this->candidateList);
            array_walk($results, function(&$v, $k){ $v = 0;} );
        }
        print_r($results);
        return $results;
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    public function addVote($candidateName)
    {
        $this->results[$candidateName]++;
        $this->writeDataToJSONFile();
    }

    /**
     * @param array|mixed $data
     */
    private function writeDataToJSONFile(): void
    {
        file_put_contents($this->fileName, json_encode($this->results));
    }



}