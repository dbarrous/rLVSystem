<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "root";
$dBName = "lab9";

$conn = mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);

if(!$conn){
  die("Connection Failed: ".mysqli_connect_error());
}
