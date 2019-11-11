window.onload = (() => {
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    /*let dataObj = JSON.parse(<?php echo json_encode(file_get_contents($fileName));?>);*/
    const dataArray = [['candidate', 'Qnt of votes'],];
    for (let entry in dataObj) {
        dataArray.push([entry, dataObj[entry]]);
    }

    const data = google.visualization.arrayToDataTable(dataArray);

    const options = {
        title: chartOptionTitle};

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}
})