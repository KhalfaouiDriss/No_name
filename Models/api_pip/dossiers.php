<?php
include '../../Config/config.php';

$dossiers_query = "SELECT * FROM dossiers";

$result = mysqli_query($conn,$dossiers_query);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<pre>";
echo json_encode($row);
echo "</pre>";
?>