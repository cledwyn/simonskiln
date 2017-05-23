<?php 
$servername = "mysql.YOURSEERVER.com";
$username = "YOURUSERNAME";
$password = "YOURPASSWORD";
$dbname = "YOURDBNAME";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// some settings for firebase
const DEFAULT_URL = 'https://YOURFIREBASEINSTANCENAME.firebaseio.com/';
const DEFAULT_TOKEN = 'YOURSECRETTOKEN';
const DEFAULT_PATH = '/kilnlogger/';
