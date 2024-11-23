<?php

$reparations_query = "SELECT * FROM reparations";

$reparations_queryresult = mysqli_query($conn,$reparations_query);
$reparations_row = mysqli_fetch_all($reparations_queryresult, MYSQLI_ASSOC);


// echo "<pre>";
// json_encode($row);
// echo "</pre>";


?>