<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Выводит все глобальные переменные</title>
    <meta charset='utf-8'>
</head>
<body>
<?php if (!isset($_REQUEST['doGo'])) {?>
    <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="get">
        Логин: <input type="text" name="form[login]" value=""><br />
        Пароль: <input type="password" name="form[password]" value=""><br />
        <select name="form[options][]" multiple>
            <option>First<loption>
            <option>Second</option>
            <option>Third</option>
        </select><br />
        <input type="submit" name="doGo" value="Нажмите кнопку!">
    </form>
<?php } else {
    if ($_REQUEST['form']['login'] == "root" && $_REQUEST['form']['password'] == "Z10N0101") {
        echo "Доступ открыт для пользователя {$_REQUEST['form']['login']}";
        // Команда блокирования рабочей станции (работает в NT-системах)
        //system("rundll32.exe user32.dll,LockWorkStation");
    } else {
        echo "Доступ закрыт!";
    }
} ?>
<?php

// Вначале счетчик равен нулю.
$count = 0;
// Если в Cookies что-то есть, берем счетчик оттуда.
if (isset($_COOKIE['count'])) $count = $_COOKIE['count'];
$count++;
// Записываем в Cookies новое значение счетчика.
setcookie("count", $count, 0x7FFFFFFF, "/");
// Выводим счетчик.
echo $count;
?>


<pre>
  <?php
  print_r($GLOBALS);
  ?>
  </pre>
</body>
</html>

<!--//    $index = mt_rand(1,10);
//    $name = "VALUE{$index}";
//    define($name, 777);
//    echo "Constant {$name} has value {"${constant($name)}"}";
//
//$a =array( 'a'=>'apple', 'b'=>'banana', 'c'=>array( 'x', 'y', 'z'));
//print_r ($a);
//echo "<pre>"; print_r ($a); echo "</pre>";-->
<!--
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
?>-->

