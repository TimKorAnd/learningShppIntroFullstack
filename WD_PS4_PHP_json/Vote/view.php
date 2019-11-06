<!-- MVC. Vote view -->
<html>
<head>
  <link rel="stylesheet" href="styles/styles.css">
  <title> WD_PS4 Vote </title>
</head>
<body>
<!--<h1>Task1 & Task2.</h1>-->

<!--<h1>Task8. Character count</h1>-->
<form id="voteList" action="index.php" method="post">
  <fieldset>
    <legend>Vote for just one</legend>
    <?php
        $count = 0;
        foreach ( $candidateList as $candidate ) {
            echo '<label for='.$candidate.'>'.$candidate.' </label>';
            echo '<input type="radio" id="'.$candidate.$count.'" name="'.$voteSetName.'"
             value="'.$count++.'">';
        }
    ?>

      <?php
          echo '<input type="submit" id="'.$voteSetName.'__sbmt-btn" name="'.$voteSetName.'__sbmt-btn" value="vote finally">';
      ?>


  </fieldset>
</form>

</body>
</html>