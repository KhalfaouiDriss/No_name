<?php

$documents_query = "SELECT * FROM documents";

$documents_queryresult = mysqli_query($conn,$documents_query);
$documents_row = mysqli_fetch_all($documents_queryresult, MYSQLI_ASSOC);

// echo "<pre>";
// echo json_encode($row);
// echo "</pre>";
?>