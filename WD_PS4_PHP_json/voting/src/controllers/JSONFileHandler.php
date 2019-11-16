<?php


/**
 * Class JSONFileHandler processing JSON file
 */
class JSONFileHandler
{
    private $data = [];
    private $fileName;
    private $candidateList;

    /**
     * WarmUpFileHandler constructor.
     * @param $fileName
     * @param $candidateList
     */
    public function __construct($fileName, $candidateList)
    {
        $this->fileName = $fileName;
        $this->candidateList = $candidateList;
        $this->data = $this->getDataFromJSONFile();


    }

    /** read data from json file , if file is empty return basic candidatelist from config
     * @return array
     * TODO need compare basic list with file/ check actuality & clear redundant from file
     */
    public function getDataFromJSONFile()
    {
        $results = json_decode(file_get_contents($this->fileName),TRUE);
        if (empty($results)){
            $results = array_flip($this->candidateList);
            array_walk($results, function(&$v, $k){ $v = 0;} );
        }
        return $results;
    }

    /**Add vote to specify candidate in json file
     * @param $candidateName
     */
    public function addVote($candidateName)
    {
        $this->data[$candidateName]++;
        $this->writeDataToJSONFile();
    }

    /** write to file
     * @param array|mixed $data
     */
    private function writeDataToJSONFile(): void
    {
        file_put_contents($this->fileName, json_encode($this->data));
    }



}