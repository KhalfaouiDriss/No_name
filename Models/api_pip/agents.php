<?php
include '../../Config/config.php';

$agent_query = "SELECT * FROM agents WHERE role = 'expert'";

$result = mysqli_query($conn,$agent_query);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<pre>";
echo json_encode($row);
echo "</pre>";
?>