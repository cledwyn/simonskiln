<?php
include 'settings.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Simon's Kiln Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">

	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>

</head>
<body>



<div id="container" ></div>

<h2>
<?php
$sql = "SELECT *, ADDTIME(ts,'0 2:00:00') as tss FROM logger where field = 't' order by ts desc limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {       
        echo "now: ".$row["val"]. " degrees.<br />:)";
    }
} else {
    echo "0 results";
}
?>
</h2>



<div class="topcorner" onclick="window.location.href = '/'">
<img src="mug.svg" alt="about" style="height: 15px">
</div>

<script>
Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Mill Creek Pottery Kiln Temp'
    },
    subtitle: {
        text: 'Data Logging brought to you by chewing gum and bailing wire.'
    },
    xAxis: {
        type: 'datetime',
        dateTimeLabelFormats: { // don't display the dummy year
            month: '%e. %b',
            year: '%b'
        },
        title: {
            text: 'Date'
        }
    },
    yAxis: {
        title: {
            text: 'Kiln Temp (F)'
        },
        // min: 0
    },
    tooltip: {
        headerFormat: '<b>{series.name}</b><br>',
        pointFormat: '{point.x:%b %e %I:%M %p}: {point.y:.0f} deg F'
    },

    plotOptions: {
        spline: {
            marker: {
                enabled: true
            }
        }
    },

    series: [{
        name: 'WorkShop Firing 2017 - Mill Creek Pottery',
        // Define the data points. All series have a dummy year
        // of 1970/71 in order to be compared on the same x axis. Note
        // that in JavaScript, months start at 0 for January, 1 for February etc.
        data: [
        <?php
$sql = "SELECT *, ADDTIME(ts,'0 2:00:00') as tss FROM logger where field = 't' and concat('',val * 1) = val  and ts > '2017-05-20' order by ts desc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {       
    	// Split timestamp into [ Y, M, D, h, m, s ]
    	$t = preg_split("/[- :]/", $row["tss"]);
    	echo "[Date.UTC(".$t[0].", ".((int)$t[1]-1).", ".(int)$t[2].", ".(int)$t[3].", ".(int)$t[4]."), ".$row["val"]."],\n";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
        ]
    }]
});
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48607929-4', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>