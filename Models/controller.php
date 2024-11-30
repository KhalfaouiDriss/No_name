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
    // Sanitize user input
    $remark = htmlspecialchars(trim($_POST['remark'])); 
    $ref_dossier = htmlspecialchars(trim($_SESSION['referance'])); // Ensure session variable is safe

    // Update the "consulté" field in the "dossiers" table for the specified "referance"
    $query = "UPDATE dossiers SET consulté = '$remark' WHERE reference = '$ref_dossier'";

    if (mysqli_query($conn, $query)) {
        // Redirect to success page or display a success message
        $_SESSION['message'] = "Merci pour votre remarque!";
        header("Location: ../Views/index.php?page=index");
        exit();
    } else {
        // Handle insertion failure
        $_SESSION['error'] = "Erreur lors de l'envoi de la remarque.";
        header("Location: ../Views/index.php?page=index");
        exit();
    }
}




















?>