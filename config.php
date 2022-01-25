<?php
 define("DBHOST", "localhost");
 define("DBUSER", "root");
 define("DBPASS", "");
 define("DBNAME", "beyamooz_hotel");

 $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
 mysqli_set_charset($conn, "utf8");
 if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
?>
