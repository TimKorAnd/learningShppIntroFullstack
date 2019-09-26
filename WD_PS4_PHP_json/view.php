<!-- MVC. Warmup view -->
<html>
<head>
  <link rel="stylesheet" href="styles/styles.css">
  <title> WD_PS4 Warmup </title>
</head>
<body>
<!--<h1>Task1 & Task2.</h1>-->

<form id="task1-2-calculate" action="index.php" method="post">

<fieldset>
  <legend>Task1 & Task2</legend>
    <label for="task1-from">Enter from:</label>
    <input type="number" id="task1-from" name="task1-2[from]" value="">
    <label for="task1-to"> Enter to:</label>
    <input type="number" id="task1-to" name="task1-2[to]"><br />
    <!--for choose algorithm of calculating between task1 or task2-->
  <div>
    <label for="task1-calculate"> Calculate all digits in range</label>
    <input type="hidden" name="task1-2[taskStatus][task1]" value="0">
    <input type="checkbox" id= "task1-calculate" name="task1-2[taskStatus][task1]" value="1">
    <?php if (!empty($task12Obj)) {
        echo $calcResults['task1'];
    } ?>
  </div>
  <div>
    <label for="task2-calculate"> Calculate only digits which ends of 2,3,7 in range</label>
    <input type="hidden" name="task1-2[taskStatus][task2]" value="0">
    <input type="checkbox" id= "task2-calculate" name="task1-2[taskStatus][task2]" value="1">
      <?php if (!empty($task12Obj)) {
          echo $calcResults['task2'];
      } ?>
  </div>

    <input id="task12__sbmt-btn" type="submit" name="doAdd" value="Sum">
</fieldset>
</form>
<!--<h1>Task1 & Task2.</h1>-->
<!--<h1>Task3. File upload</h1>-->
<form id="task3-fileUpload" action="index.php" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend>Task3. Files upload</legend>
    <input type="file" id="task3__fileToUpload" name="task3__fileToUpload">
    <input type="submit" id="task3__sbmt-btn" name="task3__sbmt-btn" value="Upload">

      <div style="width=100%">
        <?php
          if (isset($fileHandler))
              $fileHandler->displayFileList();
         ?>
      </div>

  </fieldset>

<!--<h1>Task3. File upload</h1>-->

</body>
</html>