<?php
include_once '../../Config/config.php';

/**
 * Deletes a dossier, its related records, and associated images from the project.
 *
 * @param int $id The ID of the dossier to delete.
 * @param mysqli $conn The database connection object.
 * @return array An array containing 'success' and 'message'.
 */
function deleteDossier($id, $conn)
{
    if ($id <= 0) {
        return ['success' => false, 'message' => "Invalid dossier ID"];
    }

    // Get dossier reference and folder path
    $query = "SELECT reference FROM dossiers WHERE id_dossier = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        return ['success' => false, 'message' => "Prepare failed: " . $conn->error];
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        return ['success' => false, 'message' => "Dossier not found"];
    }

    $ref = $row['reference'];
    $folder_path = "../../Stock/documents/F" . $ref;

    // Fetch image paths from the database
    $query_images = "SELECT IMG_CIN, IMG_CIN_VERSO, IMG_GC, IMG_GC_VERSO, IMG_VIN, IMG_VIN_VERSO FROM clintes WHERE reference_dos = ?";
    $stmt = $conn->prepare($query_images);
    if (!$stmt) {
        return ['success' => false, 'message' => "Prepare failed: " . $conn->error];
    }
    $stmt->bind_param("s", $ref);
    $stmt->execute();
    $result = $stmt->get_result();
    $images = [];
    while ($image_row = $result->fetch_assoc()) {
        $images = array_merge($images, array_values($image_row));
    }

    // Delete associated clients
    $query_delete_clients = "DELETE FROM clintes WHERE reference_dos = ?";
    $stmt = $conn->prepare($query_delete_clients);
    if (!$stmt) {
        return ['success' => false, 'message' => "Prepare failed: " . $conn->error];
    }
    $stmt->bind_param("s", $ref);
    if (!$stmt->execute()) {
        return ['success' => false, 'message' => "Error deleting clients: " . $stmt->error];
    }

    // Delete associated vehicles
    $query_delete_vehicles = "DELETE FROM vehicules WHERE ref_dossier = ?";
    $stmt = $conn->prepare($query_delete_vehicles);
    if (!$stmt) {
        return ['success' => false, 'message' => "Prepare failed: " . $conn->error];
    }
    $stmt->bind_param("s", $ref);
    if (!$stmt->execute()) {
        return ['success' => false, 'message' => "Error deleting vehicles: " . $stmt->error];
    }

    // Delete the dossier
    $query_delete_dossier = "DELETE FROM dossiers WHERE id_dossier = ?";
    $stmt = $conn->prepare($query_delete_dossier);
    if (!$stmt) {
        return ['success' => false, 'message' => "Prepare failed: " . $conn->error];
    }
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        return ['success' => false, 'message' => "Error deleting dossier: " . $stmt->error];
    }

    // Delete images from the project
    foreach ($images as $image_path) {
        if ($image_path && file_exists($image_path)) {
            unlink($image_path);
        }
    }

    // Delete the folder if it exists and is empty
    if (is_dir($folder_path) && count(scandir($folder_path)) <= 2) {
        rmdir($folder_path);
    }

    return ['success' => true, 'message' => "Dossier, related records, and images deleted successfully"];
}

// Usage example
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$response = deleteDossier($id, $conn);

if ($response['success']) {
    header('Location: ../../Views/index.php?page=views_dos');
    exit;
} else {
    die($response['message']);
}
?>