<?php
include_once "../Config/config.php";
include_once "insert/client_info.php";


$query_count_dos = "SELECT COUNT(*) AS dossier_count FROM dossiers";

$result = mysqli_query($conn, $query_count_dos);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $dossier_count = $row['dossier_count'];
    // echo "Total number of dossiers: " . $dossier_count;
}



if (isset($_POST['client_info'])) {
    $result = handleFormData($_POST, $_FILES, $dossier_count, $conn);

    if ($result['success']) {
        $check = insertClientData($result, $conn);

        if ($check) {
            $_SESSION['referance'] = $result['referance'];
            header("Location: ../Views/index.php?page=creat_dos&action=car_info");
            exit();
        } else {
            cleanUpFilesAndDirectories($result);
            echo "Error: Unable to insert data into the database.";
        }
    } else {
        cleanUpFilesAndDirectories($result);
        echo "Error: " . $result['message'];
    }
}

if (isset($_POST['vehicle_info'])) {
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $immatriculation = $_POST['immatriculation'];
    $ref_dossier = $_SESSION['referance']; // This should come from session or previous step

    // Insert the vehicle into the database
    $query = "INSERT INTO vehicules (marque, modele, immatriculation, ref_dossier) 
              VALUES ('$marque', '$modele', '$immatriculation', '$ref_dossier')";

    if (mysqli_query($conn, $query)) {
        // Redirect to success page or display a success message
        $_SESSION['message'] = "Véhicule ajouté avec succès";
        header("Location: ../Views/index.php?page=creat_dos&action=remarque");
    } else {
        // Handle insertion failure
        $_SESSION['error'] = "Erreur lors de l'ajout du véhicule";
        header("Location: ../Views/index.php?page=vehicule_info");
    }
}

if (isset($_POST['submit_remark'])) {
    try {
        // Sanitize user inputs
        $remark = htmlspecialchars(trim($_POST['remark']));
        $ref_dossier = htmlspecialchars(trim($_SESSION['referance'])); // Ensure session variable is safe
        $vue_status = htmlspecialchars(trim($_POST['vue_status']));

        // Set progress based on vue_status
        $prog = ($vue_status == '1') ? 40 : 20;

        // Initialize variables for file handling
        $base_dir = "../Stock/documents/F" . $ref_dossier . "/";
        $file_path = null;

        // Handle file upload if "Non Vue" is selected
        if ($vue_status == '0' && isset($_FILES['annulation_letter'])) {
            $file = $_FILES['annulation_letter'];

            // Validate file upload
            if ($file['error'] === UPLOAD_ERR_OK) {
                // Ensure dossier directory exists
                if (!file_exists($base_dir) && !mkdir($base_dir, 0777, true)) {
                    throw new Exception("Erreur: Impossible de créer le répertoire pour le dossier.");
                }

                // Validate file extension
                $allowed_extensions = ['pdf', 'txt'];
                $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                if (!in_array($file_extension, $allowed_extensions)) {
                    throw new Exception("Erreur: Format de fichier non autorisé. Seuls les fichiers PDF et TXT sont acceptés.");
                }

                // Generate unique file name and move file
                $file_name = "lettre_annulation_" . $ref_dossier . "." . $file_extension;
                $file_path = $base_dir . $file_name;

                if (!move_uploaded_file($file['tmp_name'], $file_path)) {
                    throw new Exception("Erreur lors du téléchargement de la lettre d'annulation.");
                }
            } else {
                throw new Exception("Erreur de fichier: " . $file['error']);
            }
        }

        // Update progress in the dossiers table
        $sql1 = "UPDATE dossiers SET progress = ? WHERE referance = ?";
        $stmt1 = $conn->prepare($sql1);
        if (!$stmt1) {
            throw new Exception("Erreur lors de la préparation de la requête SQL (dossiers).");
        }
        if (!$stmt1->execute([$prog, $ref_dossier])) {
            throw new Exception("Erreur lors de la mise à jour de la progression (dossiers): " . $stmt1->errorInfo()[2]);
        }
        

        // Insert into _consulté table
        $query_consulte = "INSERT INTO _consulté (ref_dos, remark, consulté) VALUES (?, ?, ?)";
        $stmt2 = $conn->prepare($query_consulte);
        $stmt2->bind_param('sss', $ref_dossier, $remark, $vue_status);
        if (!$stmt2->execute()) {
            throw new Exception("Erreur lors de l'envoi de la remarque (_consulté): " . $stmt2->error);
        }

        // Update lettre_annulation in dossiers table
        $query_dossiers = "UPDATE dossiers SET lettre_annulation = ? WHERE referance = ?";
        $stmt3 = $conn->prepare($query_dossiers);
        $stmt3->bind_param('ss', $file_path, $ref_dossier);
        if (!$stmt3->execute()) {
            throw new Exception("Erreur lors de la mise à jour de la lettre d'annulation (dossiers): " . $stmt3->error);
        }

        // Success
        $_SESSION['message'] = "Merci pour votre remarque!";
        header("Location: ../Views/index.php?page=index");
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../Views/index.php?page=index");
        exit();
    }
}



?>