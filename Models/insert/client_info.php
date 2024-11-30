<?php

function generate_reference($name, $last_name, $dos_count, $conn)
{
    $date = date("dmy");
    $proposed_ref = $date . strtoupper($name[0]) . strtoupper($last_name[0]) . ($dos_count);

    $stmt = $conn->prepare("SELECT 1 FROM dossiers WHERE reference = ? LIMIT 1");
    $stmt->bind_param("s", $proposed_ref);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        return false;
    }

    $stmt->close();
    return $proposed_ref;
}

function handleFormData($data, $files, $dossier_count, $conn)
{
    $date_creation = date("Y-m-d H:i:s");
    $client_first_name = htmlspecialchars($data['client_first_name']);
    $client_last_name = htmlspecialchars($data['client_last_name']);
    $phone_number = htmlspecialchars($data['phone_number']);
    $email = htmlspecialchars($data['email']);
    $cin_number = htmlspecialchars($data['cin_number']);
    $card_grise_number = htmlspecialchars($data['card_grise_number']);

    $referance = generate_reference($client_first_name, $client_last_name, $dossier_count, $conn);

    // Validate file inputs
    $required_files = ['cin_img_recto', 'cin_img_verso', 'card_grise_img_recto', 'card_grise_img_verso', 'VIN_img_recto', 'VIN_img_verso'];
    foreach ($required_files as $file_key) {
        if (!isset($files[$file_key]) || $files[$file_key]['error'] !== UPLOAD_ERR_OK) {
            return [
                'success' => false,
                'message' => "File $file_key is missing or failed to upload.",
            ];
        }
    }

    // Set upload directory
    $upload_dir = "../Stock/documents/F" . $referance;
    if (!file_exists($upload_dir) && !mkdir($upload_dir, 0777, true)) {
        return [
            'success' => false,
            'message' => 'Failed to create upload directory.',
        ];
    }

    // Define file paths
    $file_paths = [];
    foreach ($required_files as $file_key) {
        $file_extension = pathinfo($files[$file_key]['name'], PATHINFO_EXTENSION);
        $file_paths[$file_key] = $upload_dir . '/' . strtoupper($file_key) . '_' . $referance . '.' . $file_extension;
    }

    // Upload files
    foreach ($required_files as $file_key) {
        if (!move_uploaded_file($files[$file_key]['tmp_name'], $file_paths[$file_key])) {
            return [
                'success' => false,
                'message' => "Failed to upload file: $file_key.",
            ];
        }
    }

    // Return success data with file paths
    return [
        'success' => true,
        'referance' => $referance,
        'date_creation' => $date_creation,
        'client_first_name' => $client_first_name,
        'client_last_name' => $client_last_name,
        'phone_number' => $phone_number,
        'email' => $email,
        'cin_number' => $cin_number,
        'card_grise_number' => $card_grise_number,
        'cin_img_recto_path' => $file_paths['cin_img_recto'],
        'cin_img_verso_path' => $file_paths['cin_img_verso'],
        'card_grise_img_recto_path' => $file_paths['card_grise_img_recto'],
        'card_grise_img_verso_path' => $file_paths['card_grise_img_verso'],
        'VIN_img_recto_path' => $file_paths['VIN_img_recto'],
        'VIN_img_verso_path' => $file_paths['VIN_img_verso'],
        'message' => 'Form submitted and files uploaded successfully.',
    ];
}


function insertClientData($data, $conn)
{
    try {
        $id_agent = 1;

        $sql = "INSERT INTO clintes (reference_dos, first_name, last_name, phone, email, CIN, CG, IMG_CIN, IMG_CIN_VERSO, IMG_GC, IMG_GC_VERSO, IMG_VIN, IMG_VIN_VERSO)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sql1 = "INSERT INTO dossiers (reference, progress, date_creation, id_agent, charts) VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt1 = $conn->prepare($sql1);

        if (!$stmt || !$stmt1) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $charts = date("m/y");

        $stmt->bind_param(
            'sssssssssssss',
            $data['referance'],
            $data['client_first_name'],
            $data['client_last_name'],
            $data['phone_number'],
            $data['email'],
            $data['cin_number'],
            $data['card_grise_number'],
            // $data['date_permis'],
            $data['cin_img_recto_path'],
            $data['cin_img_verso_path'],
            $data['card_grise_img_recto_path'],
            $data['card_grise_img_verso_path'],
            $data['VIN_img_recto_path'],
            $data['VIN_img_verso_path']
        );

        $progress = 20;
        $stmt1->bind_param(
            'sssis',
            $data['referance'],
            $progress,
            $data['date_creation'],
            $id_agent,
            $charts
        );

        if (!$stmt->execute()) {
            throw new Exception("Execution failed for clients: " . $stmt->error);
        }

        if (!$stmt1->execute()) {
            throw new Exception("Execution failed for dossiers: " . $stmt1->error);
        }

        $stmt->close();
        $stmt1->close();

        return true;

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function cleanUpFilesAndDirectories($result)
{
    if (is_dir($result['referance'])) {
        deleteDirectory($result['referance']);
    }

    $uploaded_files = [
        $result['cin_img_recto_path'],
        $result['cin_img_verso_path'],
        $result['card_grise_img_recto_path'],
        $result['card_grise_img_verso_path'],
        $result['permis_img_recto_path'],
        $result['permis_img_verso_path']
    ];

    foreach ($uploaded_files as $file) {
        if (file_exists($file)) {
            unlink($file);
        }
    }
}

function deleteDirectory($dir)
{
    $files = array_diff(scandir($dir), array('.', '..'));

    foreach ($files as $file) {
        $filePath = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($filePath)) {
            deleteDirectory($filePath);
        } else {
            unlink($filePath);
        }
    }

    rmdir($dir);
}
?>