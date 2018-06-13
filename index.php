<?php
include 'settings.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Simon's Kiln Page</title>
    <link rel="stylesheet" type="text/css" href="style.css?v=2">

    <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script> 
    <script src="https://www.gstatic.com/firebasejs/4.0.0/firebase.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

</head>
<body>

<div id="container" ></div>

<h2 id="templabel">
<?php
$sql = "SELECT *, ADDTIME(ts,'0 2:00:00') as tss FROM logger where field = 't' and coreid = '510038000c51353432393339' and ts between '2017-09-08' and '2017-09-30' order by ts desc limit 1";
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
<div id="lastupdated"></div>

<div class="topcorner" onclick="window.location.href = 'https://github.com/cledwyn/simonskiln'">
    <img src="img/Octocat.jpg" alt="about" style="height: 15px">
</div>

<script src="script.js"></script>
<div style="clear:both;">
</div>

<!-- <script async defer src="//platform.instagram.com/en_US/embeds.js"></script> -->

</body>
</html>