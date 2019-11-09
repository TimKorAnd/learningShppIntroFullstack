<?php


class FileHandler
{
    private $results = [];

    /**
     * FileHandler constructor.
     */
    public function __construct($fileName)
    {
        $this -> results =  json_decode(file_get_contents($fileName),TRUE);
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param array|mixed $results
     */
    public function setResults($results): void
    {
        $this->results = $results;
    }



}