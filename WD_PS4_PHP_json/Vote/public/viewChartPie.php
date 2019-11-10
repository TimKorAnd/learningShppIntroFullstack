<?php
    //require_once('./index.php');
    setcookie($isVoter,'true', time() + $voteLifetime);
    /*echo 'there will pie chart display for'.'<br/>';
    echo $choosedCandidate.'<br/>';
    //print_r();*/
?>
<html>
<head>

</head>
<body>
<div id="piechart" style="width: 900px; height: 500px;"></div>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        let dataObj = JSON.parse(<?php echo json_encode(file_get_contents($fileName));?>);
        const dataArray = [['candidate', 'Qnt of votes'],];
        for (let entry in dataObj) {
            dataArray.push([entry, dataObj[entry]]);
        }

        const data = google.visualization.arrayToDataTable(dataArray);

        const options = {
            title: '<?php echo $votingName ?>'};

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
</body>
</html>
