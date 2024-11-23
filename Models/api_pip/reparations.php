<?php
include '../../Config/config.php';

$reparations_query = "SELECT * FROM reparations";

$result = mysqli_query($conn,$reparations_query);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<pre>";
echo json_encode($row);
echo "</pre>";
?>