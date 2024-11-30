<?php
include_once '../../Config/config.php';

// Validate and sanitize input
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("Invalid dossier ID");
}

// Get dossier reference
$query = "SELECT reference FROM dossiers WHERE id_dossier = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Dossier not found");
}

$ref = $row['reference'];

// Delete associated clients
$query_delete_clients = "DELETE FROM clintes WHERE reference_dos = ?";
$stmt = $conn->prepare($query_delete_clients);
$stmt->bind_param("s", $ref);
if (!$stmt->execute()) {
    die("Error deleting clients: " . $stmt->error);
}

// Delete associated vehicles
$query_delete_vehicles = "DELETE FROM vehicules WHERE ref_dossier = ?";
$stmt = $conn->prepare($query_delete_vehicles);
$stmt->bind_param("s", $ref);
if (!$stmt->execute()) {
    die("Error deleting vehicles: " . $stmt->error);
}

// Delete the dossier
$query_delete_dossier = "DELETE FROM dossiers WHERE id_dossier = ?";
$stmt = $conn->prepare($query_delete_dossier);
$stmt->bind_param("i", $id);
if (!$stmt->execute()) {
    die("Error deleting dossier: " . $stmt->error);
}

// Redirect after successful deletion
header('Location: ../../Views/index.php?page=views_dos');
exit;
?>
