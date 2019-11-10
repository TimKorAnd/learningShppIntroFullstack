<?php
    require_once('./index.php');
    setcookie($isVoter,'true', time() + $voteLifetime);
    echo 'there will pie chart display for'.'<br/>';
    echo $choosedCandidate.'<br/>';
    //print_r();
?>
<html>
<head>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            let dataArr = [];
            dataArr = <?php echo json_encode(file_get_contents($fileName));?>;
            //const data1 = JSON.parse(<?php //echo json_encode($voteHandler->getData()); ?>//);
            //for (let i = 0; i < data1.length; i++) {
            //    dataArr.push(data1[i]);
            //}
            dataArr.forEach((elem)=>{
                console.log(elem);
            });
            console.log(dataArr);
            const data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Work',     11],
                ['Eat',      2],
                ['Commute',  2],
                ['Watch TV', 2],
                ['Sleep',    7]
            ]);

            var options = {
                title: 'My Daily Activities'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div id="piechart" style="width: 900px; height: 500px;"></div>
</body>
</html>
<!--
-->