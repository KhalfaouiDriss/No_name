<?php

$conn = new mysqli("localhost", "root", "", "gestionaccidents1");

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}
if (!session_start())
{
    session_start();
}
?>