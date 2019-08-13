
<?php
    $index = mt_rand(1,10);
    $name = "VALUE{$index}";
    define($name, 777);
    echo "Constant {$name} has value {${constant($name)}}";

$a =array( 'a'=>'apple', 'b'=>'banana', 'c'=>array( 'x', 'y', 'z'));
print_r ($a);
echo "<pre>"; print_r ($a); echo "</pre>";
?>