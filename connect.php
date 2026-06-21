<?php
header('Content-Type: text/html; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = "";
$database = "projekt";

$dbc = mysqli_connect(
    $servername,
    $username,
    $password,
    $database
) or die("Greška pri spajanju.");

mysqli_set_charset($dbc, "utf8");
?>