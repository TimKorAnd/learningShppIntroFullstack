<?php
    setcookie($isVoter,'true', time() + $voteLifetime);
?>
<html>
<head>

</head>
<body>
<div id="piechart" style="width: 900px; height: 500px;"></div>
<script defer src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    const dataObj = JSON.parse(<?php echo json_encode(file_get_contents($fileName));?>);
    const chartOptionTitle = '<?php echo $votingName ?>';
    /*TODO how can do it else??*/
</script>
<script src="js/chartScript.js"></script>
</body>
</html>
