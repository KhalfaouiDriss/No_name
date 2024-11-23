<?php
include '../../Config/config.php';

$documents_query = "SELECT * FROM documents";

$result = mysqli_query($conn,$documents_query);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<pre>";
echo json_encode($row);
echo "</pre>";
?>