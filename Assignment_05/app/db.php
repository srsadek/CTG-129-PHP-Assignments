<?php

$host = "localhost";
$username = "root";
$password = "";
$db_name = "srs_lms";



function getMySqlConenction(){
    global $host, $username, $password, $db_name;
    return new mysqli($host, $username, $password, $db_name);
}