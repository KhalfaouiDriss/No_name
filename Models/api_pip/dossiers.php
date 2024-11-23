<?php

$dossiers_query = "SELECT * FROM dossiers";

$dossiers_queryresult = mysqli_query($conn,$dossiers_query);
$dossiers_row = mysqli_fetch_all($dossiers_queryresult, MYSQLI_ASSOC);


$dossiers_encoure_query = "SELECT * FROM dossiers WHERE statut = 'en cours'";

$dossiers_encoure_queryresult = mysqli_query($conn,$dossiers_encoure_query);
$dossiers_encoure_row = mysqli_fetch_all($dossiers_encoure_queryresult, MYSQLI_ASSOC);

// echo "<pre>";
// echo json_encode($row);
// echo "</pre>";
?>