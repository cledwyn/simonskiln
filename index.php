<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Simon's Kiln Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
</style>
</head>
<body>

<h1>
Hi!<br />
<?php
include 'settings.php';

$sql = "SELECT *, ADDTIME(ts,'0 2:00:00') as tss FROM logger where field = 't' order by ts desc limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       
        echo "I'm ".$row["val"]. " degrees.<br />:)";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
</h1>


<div class="topcorner" onclick="window.location.href = 'chart.php'">
<img src="mug.svg" alt="about" style="height: 15px">
</div>

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