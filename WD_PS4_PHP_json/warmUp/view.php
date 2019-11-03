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
    <input type="number" id="task1-from" name="task1-2[from]" value="<?php
            echo @$_SESSION['task1-2']['from'];
        ?>">
    <label for="task1-to"> Enter to:</label>
    <input type="number" id="task1-to" name="task1-2[to]" value="<?php
        echo @($_SESSION['task1-2']['to']);
    ?>"><br />
    <!--checkbox for choose algorithm of calculating between task1 or task2-->
  <div>
    <label for="task1-calculate"> Calculate all digits in range</label>
    <input type="hidden" name="task1-2[taskStatus][task1]" value="0">
    <input type="checkbox" id="task1-calculate" name="task1-2[taskStatus][task1]" value="1"
      <?php
          if (!empty($_SESSION['task1-2']['taskStatus']['task1'])){
              echo 'checked';
          }
      ?>>
    <?php if (!empty($calcResults)) {
        echo $calcResults['task1'];
    } ?>
  </div>
  <div>
    <label for="task2-calculate"> Calculate only digits which ends of 2,3,7 in range</label>
    <input type="hidden" name="task1-2[taskStatus][task2]" value="0">
    <input type="checkbox" id= "task2-calculate" name="task1-2[taskStatus][task2]" value="1"
      <?php
          if (!empty($_SESSION['task1-2']['taskStatus']['task2'])){
              echo 'checked';
          }
      ?>>
      <?php if (!empty($calcResults)) {
          echo $calcResults['task2'];
      } ?>
  </div>

    <input id="task12__sbmt-btn" type="submit" name="doAdd" value="Sum">
</fieldset>
</form>

<!--<h1>Task3. File upload</h1>-->
<form id="task3-fileUpload" action="index.php" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend>Task3. Files upload</legend>
    <input type="file" id="task3__fileToUpload" name="task3__fileToUpload">
    <input type="submit" id="task3__sbmt-btn" name="task3__sbmt-btn" value="Upload">

      <div class="task4__fileViewer">
        <?php
          if (isset($fileHandler)){
              $fileHandler->displayFileList();
          }
         ?>
      </div>

  </fieldset>
</form>

<!--<h1>Task4. ChessBoard</h1>-->
<form id="task4-chessboard" action="index.php" method="post">
  <fieldset>
    <legend>Task4. Chess Board</legend>
    <label for="task4__boardWidth">Enter width</label>
    <input type="number" id="task4__boardWidth" name="task4__board[width]"
      value="<?php
          echo @$_SESSION['task4__board']['width'];
      ?>">
    <label for="task4__boardHeight">Enter height</label>
    <input type="number" id="task4__boardHeight" name="task4__board[height]"
      value="<?php
            echo @$_SESSION['task4__board']['height'];
        ?>">
    <input type="submit" id="task4__sbmt-btn" name="task4__sbmt-btn" value="board">

    <div>
        <?php
          if (isset($chessBoard)){
            $chessBoard->display();
          }
        ?>
    </div>

  </fieldset>
</form>

<!--<h1>Task5. DigitSum</h1>-->
<form id="task5-digitSum" action="index.php" method="post">
    <fieldset>
        <legend>Task5. Digits Sum</legend>
        <label for="task5__digits">Enter number</label>
        <input type="number" id="task5__digits" name="task5__digits[]"
        value="<?php
            echo @$_SESSION['task5__digits'][0];
        ?>">
        <input type="submit" id="task5__sbmt-btn" name="task5__sbmt-btn" value="Sum">

        <div>
          <?php
          if (isset($digitSum)){
            $digitSum->display();
          }
          ?>
        </div>

    </fieldset>
</form>

<!--<h1>Task6. Array processing</h1>-->
<form id="task6-array-proc" action="index.php" method="post">
    <fieldset>
        <legend>Task6. Array processing </legend>
        <label for="task6__sbmt-btn">Array processing</label>
        <input type="submit" id="task6__sbmt-btn" name="task6__sbmt-btn" value="generate">

        <div>
          <?php
          if (isset($arrayProc)){
            $arrayProc->display();
          }
          ?>
        </div>

    </fieldset>
</form>

<!--<h1>Task7. Session counter</h1>-->
<form id="task7-sessCount" action="index.php" method="post">
    <fieldset>
        <legend>Task7. Session count </legend>
        <input type="submit" id="task7__sbmt-btn" name="task7__sbmt-btn" value="destroy session">
        <div>
            <?php
                if (isset($sessionCount)) {
                    $sessionCount->display();
                }
            ?>
        </div>
        <div class="task7-sessCount">
          <?php
              if (!isset($_SESSION['count'])) {
                  $_SESSION['count'] = 0;
              }
              echo ++$_SESSION['count'];
          ?>
          <p>session counter:</p>
        </div>
    </fieldset>
</form>

<!--<h1>Task8. Character count</h1>-->
<form id="task8-charCount" action="index.php" method="post">
  <fieldset>
    <legend>Task8. Char couner </legend>
    <!--<label for="task8__chars">enter some chars</label>-->
    <textarea id="task8__chars" name="task8__chars[]"><?php
        echo @$_SESSION['task8__chars'][0];
        ?></textarea>
    <input type="submit" id="task8__sbmt-btn" name="task8__sbmt-btn" value="char calc">

    <div>
        <?php
        if (isset($charCount)){
            echo $charCount->getCharCount();
            $_SESSION['task8__chars']['result'] = $charCount->getCharCount();
        } else {
            echo @$_SESSION['task8__chars']['result'];
        }
        ?>
    </div>

  </fieldset>
</form>

</body>
</html>