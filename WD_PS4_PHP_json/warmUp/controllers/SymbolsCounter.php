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
            '/(\r?\n)/um',
            '/(\s)/um',
            //'/[☀-⛿😀-🙏]/um',
          //'/[☀-⛿]|[😀-😾]|[👨‍👩‍👧‍👦]{1,2}?[👨‍👩‍👧‍👦]{1,2}?[👨‍👩‍👧‍👦]{1,2}[👨‍👩‍👧‍👦]{0,2}|[👥-👶]|[🌂-🧥]|[👃-👶][🏻-🏿]|[🌫-🐶]|[🍏-🥢]|[⚽-🎰]|[🌁-🚗]|[⌚-🔓]|[❤-🕧]|🏳|🏳️‍🌈|🏴‍☠️|[☠-🌈]]|[🇦-🇿][🇦-🇿]/um',
          '/[☀-⛿]|[😀-😾]|[👨‍👩‍👧‍👦]{2,4}|[👥-👶]|[🌂-🧥]|[👃-👶][🏻-🏿]|[🌫-🐶]|[🍏-🥢]|[⚽-🎰]|[🌁-🚗]|[⌚-🔓]|[❤-🕧]|🏳|🏳️‍🌈|🏴‍☠️|[☠-🌈]]|[🇦-🇿][🇦-🇿]/um',
            '/.+?/um'
          //'/[☀-⛿]|[😀-😾]|[👶-👥]|[🧥-🌂]|[👶🏻-👃🏻]|[👶🏼-👃🏼]|[👶🏽-👃🏾]|[👶🏿-👃🏿]|[🐶-🌫]|[🍏-🥢]|[⚽-🎰]|[🚗-🌁]|[⌚-🔓]|[❤-🕧]|[🏳-🇿🇼]]/um'
          //'/[☀-⛿]|[😀-😾]|[👶-👥]|[🧥-🌂]|[👶🏻-👃🏻]|[👶🏼-👃🏼]|[👶🏽-👃🏾]|[👶🏿-👃🏿]|[🐶-🌫]|[🍏-🥢]|[⚽-🎰]|[🚗-🌁]|[⌚-🔓]|[❤-🕧]|[🏳-🇿🇼]]/um'
        ];
        $testCounter = 0;
        //$testVar = preg_replace("/(\\x{00a9}|\x{00ae}|[\x{2000}-\x{3300}]|\x{d83c}[\x{d000}-\x{dfff}]|\x{d83d}[\x{d000}-\x{dfff}]|\x{d83e}[\x{d000}-\x{dfff}])/u", '', $str, -1, $testCounter);
        //$testVar = preg_replace('/[☀-⛿]|[😀-😾]|[👨‍👩‍👧‍👦]+|[👥-👶]|[🌂-🧥]|[👃-👶][🏻-🏿]|[🌫-🐶]|[🍏-🥢]|[⚽-🎰]|[🌁-🚗]|[⌚-🔓]|[❤-🕧]|🏳|🏳️‍🌈|🏴‍☠️|[☠-🌈]]|[🇦-🇿][🇦-🇿]/um', '', $str, -1, $testCounter);
        foreach ($patterns as $pattern) {
            $str = preg_replace($pattern, '', $str, -1, $countReplace);
            $this->symbQuant[] = $countReplace;
        }
        if ($this->symbQuant[0]|$this->symbQuant[1]|$this->symbQuant[2]|$this->symbQuant[3]) {
            $this->symbQuant[0]++;
        }
        //$this->symbQuant[3] = mb_strlen($str);
        $this->symbQuant[0].=' rows; ';
        $this->symbQuant[1].=' spaces; ';
        $this->symbQuant[2].=' smile(s); ';
        $this->symbQuant[3].=' other symbols; ';

        return $this->symbQuant;

        //preg_match_all('/s/', '');
    }
}