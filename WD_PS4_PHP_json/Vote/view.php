<!-- MVC. Vote view -->
<html>
<head>
  <link rel="stylesheet" href="styles/styles.css">
  <title> WD_PS4 Vote </title>
</head>
<body>
<!--<h1>Task1 & Task2.</h1>-->

<!--<h1>Task8. Character count</h1>-->
<form id="vote__list" action="index.php" method="post">
  <fieldset>
    <legend>Vote for just one</legend>
    <?php
    echo "<label for=\"$labelFor\"> $labelText </label>"
    <input type="radio" <?php ?>sid="task8__chars" name="task8__chars[]"><?php
        echo @$_SESSION['task8__chars'][0];
        ?>
  ?>
    <input type="submit" id="task8__sbmt-btn" name="task8__sbmt-btn" value="char calc">


  </fieldset>
</form>

</body>
</html>