<?php


class SymbolsCounter
{
    use ValueStorage;
    private $str = '';
    private $symbQuant = [];
    public function __construct()
    {
        $this->str = $_POST['task8__chars'][0];
        //$this->charCount = mb_strlen($this->str);
        $this->symbQuant = $this->calcSymbQuant($this->str);
        $this->saveValues('task8__chars');
    }


    public function getSymbQuant()
    {
        return $this->symbQuant;
    }

    private function calcSymbQuant(string $str)
    {
        $patterns = [
            '/(\r?\n)/m',
            '/(\s)/m',
            '/(\r?\n)|(\s)|(\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF])/m'
        ];
        preg_match_all('/(\r?\n)/us', $str, $matches, PREG_SET_ORDER);
        //$this->symbQuant[] = count($matches);
        $str = preg_replace('/(\r?\n)/um', '', $str, -1, $countReplace);
        $this->symbQuant[] = $countReplace;

        preg_match_all('/(\s)/m', $str, $matches, PREG_SET_ORDER);
        //$this->symbQuant[] = count($matches);
        $str = preg_replace('/(\s)/um', '', $str, -1, $countReplace);
        $this->symbQuant[] = $countReplace;

        preg_match_all('/(\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF])/m', $str, $matches, PREG_SET_ORDER);
        //$this->symbQuant[] = count($matches);
        $str = preg_replace('/(\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF])/um', '', $str, -1, $countReplace);
        $this->symbQuant[] = $countReplace;
        return $this->symbQuant;
        //preg_match_all('/s/', '');
    }
}