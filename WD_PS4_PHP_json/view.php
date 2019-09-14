<!-- MVC. Warmup view -->
<html><head><title> WD_PS4 Warmup </title></head>
<body>
<h1>Task1.</h1>
<form action="./controller.php" method="post">
  <label for="task1-from">Enter from:</label>
  <input type="number" id="task1-from" name="task1-from"><br />
  <label for="task1-to">Enter to:</label>
  <input type="number" id="task1-to" name="task1-to"><br />
  <input type="submit" name="doAdd" value="Sum">
</form>
<h2>Result is</h2>
<?php echo $result; ?>

</body></html>