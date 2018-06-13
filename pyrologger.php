<?php
include 'settings.php';

$data = $_POST["data"];

if($data){
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    if(isset($_POST['coreid'])){
        $fld = $_POST['event'];
        $val = $_POST['data'];
        $coreid = $_POST['coreid'];
        //Log the data into MySQL
        //$sql = "Insert into logger(field,val,coreid) values ('$fld','$val','$coreid')";
        //use prepared statement in PDO syntax to avoid sql injections
        $stmt = $dbh->prepare("INSERT INTO logger(field,val,coreid) values (:field, :value, :coreid)");
        $stmt->bindParam(':field', $fld);
        $stmt->bindParam(':value', $val);
        $stmt->bindParam(':coreid', $coreid);
        $stmt->execute();

        //Log the data into Firebase
        $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
        $dateTime = new DateTime();
        $dateTimeZone = new DateTimeZone('America/Chicago');        
        $dateTime->setTimeZone($dateTimeZone);
        $fb = array('event' => $fld,
            'data' => floatval($val) > 0 ? floatval($val) : $val,
            'time'=> $dateTime->format('c')
         );
        $firebase->set(DEFAULT_PATH . '/' . $coreid . '/'. $dateTime->format('c'), $fb);
    }
    $conn->close();
}
