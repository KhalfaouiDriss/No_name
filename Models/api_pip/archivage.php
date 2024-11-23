<?php

$archivage_query = "SELECT * FROM archivage";

$archivage_queryresult = mysqli_query($conn,$archivage_query);
$archivage_row = mysqli_fetch_all($archivage_queryresult, MYSQLI_ASSOC);

// echo "<pre>";
// echo json_encode($row);
// echo "</pre>";
?>