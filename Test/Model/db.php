<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "wholesale_mart";

$conn = new mysqli($serverName, $userName, $password, $databaseName) or die("Connection failed!");
