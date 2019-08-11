
<?php
    $index = mt_rand(1,10);
    $name = "VALUE{$index}";
    define($name, 777);
    echo "Constant {$name} has value {${constant($name)}}";
?>