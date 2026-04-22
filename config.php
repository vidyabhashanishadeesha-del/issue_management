<?php
$conn = mysqli_connect("localhost","root","","bims_db"); // database name here

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>

