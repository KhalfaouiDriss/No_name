<?php
include '../../Config/config.php';

$archivage_query = "SELECT * FROM archivage";

$result = mysqli_query($conn,$archivage_query);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<pre>";
echo json_encode($row);
echo "</pre>";
?>