<?php


class CharCount
{
    use ValueStorage;
    private $str = '';
    private $charCount = '';
    public function __construct()
    {
        $this->str = $_POST['task8__chars'][0];
        $this->charCount = mb_strlen($this->str);
        $this->saveValues('task8__chars');
    }


    public function getCharCount()
    {
        return $this->charCount;
    }
}