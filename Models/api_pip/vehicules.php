<?php

$vehicules_query = "SELECT * FROM vehicules";

$vehicules_queryresult = mysqli_query($conn,$vehicules_query);
$vehicules_row = mysqli_fetch_all($vehicules_queryresult, MYSQLI_ASSOC);

// echo "<pre>";
// echo json_encode($vehicules_row);
// echo "</pre>";
?>