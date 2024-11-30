<?php

include '../Config/config.php';
$id_dossier = $_GET['id'];
// Fetch dossier data
$dossier_query = "SELECT * FROM dossiers WHERE id_dossier = $id_dossier";
$dossier_result = mysqli_query($conn, $dossier_query);
$dossier = mysqli_fetch_assoc($dossier_result);

// Fetch related client data
$client_query = "SELECT * FROM clintes WHERE reference_dos = '{$dossier['reference']}'";
$client_result = mysqli_query($conn, $client_query);
$client = mysqli_fetch_assoc($client_result);

// Fetch other related data as needed
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>View Dossier</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Dossier Details</h1>
    <div class="card mt-3">
        <div class="card-header bg-primary text-white">Dossier Information</div>
        <div class="card-body">
            <p><strong>Reference:</strong> <?php echo htmlspecialchars($dossier['reference']); ?></p>
            <p><strong>Date of Creation:</strong> <?php echo htmlspecialchars($dossier['date_creation']); ?></p>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($dossier['statut']); ?></p>
            <p><strong>Progress:</strong> <?php echo htmlspecialchars($dossier['progress']); ?>%</p>
        </div>
    </div>

    <?php if ($client): ?>
        <div class="card mt-3">
            <div class="card-header bg-success text-white">Client Information</div>
            <div class="card-body">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($client['first_name'] . ' ' . $client['last_name']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($client['phone']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($client['email']); ?></p>
                <p><strong>CIN:</strong> <?php echo htmlspecialchars($client['CIN']); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Add similar sections for other related data, e.g., devis, documents, reparations -->
</div>
</body>
</html>
