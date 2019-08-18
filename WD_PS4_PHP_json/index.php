
<?php
    $index = mt_rand(1,10);
    $name = "VALUE{$index}";
    define($name, 777);
    echo "Constant {$name} has value {${constant($name)}}";
    echo "<br>";

$a =array( 'a'=>'apple', 'b'=>'banana', 'c'=>array( 'x', 'y', 'z'));
$b=['one', 'two', 'three'];
$c=['four', 'five', 'six', 'six with half'];
$d=['seven', 'eight', 'nine','','trrrr',''];
$e=['ten'];
//print_r ($a."<br>");
//print_r ($b+$c+$d+$e."<br>");
$all =  $e + $b + $c;
print_r ($all);
echo "<br>";
//$b += $c; $b += $d; $b += $e;
//$b = $c + $d + $e;
//print_r ($b);
echo "<br>";

echo "<pre>"; /*print_r ($a);*/ echo "</pre>";
?>