<?php
$agent_query = "SELECT * FROM agents WHERE role = 'expert'";

$agent_queryresult = mysqli_query($conn,$agent_query);
$agent_row = mysqli_fetch_all($agent_queryresult, MYSQLI_ASSOC);

// echo "<pre>";
// echo json_encode($agent_row);
// echo "</pre>";
?>