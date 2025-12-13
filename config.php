<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "uy_lab_php-project";


$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name);


if(!$conn){
    echo "Database Connection Failed!";
}


?>