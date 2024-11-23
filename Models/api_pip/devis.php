<?php

$devis_query = "SELECT * FROM devis";

$devis_queryresult = mysqli_query($conn,$devis_query);
$devis_row = mysqli_fetch_all($devis_queryresult, MYSQLI_ASSOC);

// echo "<pre>";
// echo json_encode($row);
// echo "</pre>";
?>