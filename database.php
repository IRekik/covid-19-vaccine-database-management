<?php
$server = "qkc353.encs.concordia.ca";
$username = "qkc353_1";
$password = "ofi3gir3";
$database = "qkc353_1";

try{
  $conn = new PDO("mysql:host=$server;port=3306;dbname=$database", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}
?>