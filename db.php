<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dbconnect';

$conn = mysqli_connect($host,$username,$password,$database);

if(mysqli_connect_errno())
{
    echo "Failed to connect";

}

?>