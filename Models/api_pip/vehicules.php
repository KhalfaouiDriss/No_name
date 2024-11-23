<?php
include '../../Config/config.php';

$vehicules_query = "SELECT * FROM vehicules";

$result = mysqli_query($conn,$vehicules_query);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<pre>";
echo json_encode($row);
echo "</pre>";
?>