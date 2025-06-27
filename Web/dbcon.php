<?php

$sname= "localhost";
$unmae= "root";
$password = "411021233";
$db_name = "testdata";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if(!$conn){
    echo "Connection failed!";
}
else{
    echo"Connection successful!";
}