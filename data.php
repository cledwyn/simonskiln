<?php
Header('Content-Type: application/json; charset=UTF8');
include 'settings.php';
$callback = "callback";
if(isset($_GET["callback"])) {
    $callback = $_GET["callback"]; 
}
echo $callback . "([\n";
$sql = "SELECT *, ADDTIME(ts,'0 2:00:00') as tss FROM logger where field = 't' and coreid = '510038000c51353432393339' and concat('',val * 1) = val  and ts  between '2017-09-08' and '2017-09-30' order by ts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {       
        // Split timestamp into [ Y, M, D, h, m, s ]
        $t = preg_split("/[- :]/", $row["tss"]); // use tss to add 2 hours from pacific TZ
        echo "[Date.UTC(".$t[0].", ".((int)$t[1]-1).", ".(int)$t[2].", ".(int)$t[3].", ".(int)$t[4].",7,0), ".$row["val"]."],\n";
    }
} else {
    echo "0 results";
}
$conn->close();
echo "]);";
