<?php
include '../../Config/config.php';

$devis_query = "SELECT * FROM devis";

$result = mysqli_query($conn,$devis_query);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<pre>";
echo json_encode($row);
echo "</pre>";
?>