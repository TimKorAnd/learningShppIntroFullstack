<!-- MVC. Warmup view -->
<html><head><title> WD_PS4 Warmup </title></head>
<body>
<h1>Task1.</h1>
<form action="./controller.php" method="post">

    <label for="task1-from">Enter from:</label>
    <input type="number" id="task1-from" name="task1-2[from]">
    <label for="task1-to"> Enter to:</label>
    <input type="number" id="task1-to" name="task1-2[to]"><br />
    <!--for choose algorithm of calculating between task1 or task2-->
    <label for="task1-calculate"> Calculate all digits in range</label>
    <input type="hidden" name="task1-2[taskStatus][1]" value="0">
    <input type="checkbox" id= "task1-calculate" name="task1-2[taskStatus][task1]" value="1">
    <label for="task2-calculate"> Calculate only digits which ends of 2,3,7 in range</label>
    <input type="hidden" name="task1-2[taskStatus][2]" value="0">
    <input type="checkbox" id= "task2-calculate" name="task1-2[taskStatus][task2]" value="1"><br />

    <input type="submit" name="doAdd" value="Sum">

</form>
<h2>Result is</h2>
<?php
    echo $result; ?>


</body></html>