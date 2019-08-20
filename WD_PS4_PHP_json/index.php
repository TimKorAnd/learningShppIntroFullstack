
<?php
//    $index = mt_rand(1,10);
//    $name = "VALUE{$index}";
//    define($name, 777);
//    echo "Constant {$name} has value {"${constant($name)}"}";
//
//$a =array( 'a'=>'apple', 'b'=>'banana', 'c'=>array( 'x', 'y', 'z'));
//print_r ($a);
//echo "<pre>"; print_r ($a); echo "</pre>";

$arr = [];
for ($col = 0; $col < 10; $col ++) {
  for ($row = 0; $row < 10; $row++) {
    $arr['col' . $col]['row' . $row] = ($col * 10) + $row;
  }
}
  print_r($arr);
echo '<br>';

  for (reset($arr); $key = key($arr);  next($arr))
  {
    $val = current($arr);
    for (reset($val); key($val);  next($val))
    {
      $lastVal = current($val);
      echo $lastVal.' ';

    }
    echo '<br>';

  }
?>