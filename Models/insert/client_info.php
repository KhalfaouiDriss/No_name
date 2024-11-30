<?php

function generate_reference($name, $last_name, $dos_count, $conn)
{
    $date = date("dmy");
    $proposed_ref_1 = $date . strtoupper($name[0]) . strtoupper($last_name[0]);
    
    
    $stmt = $conn->prepare("SELECT 1 FROM dossiers WHERE reference = ? LIMIT 1");
    $stmt->bind_param("s", $proposed_ref_1);
    $stmt->execute();
    $stmt->store_result();
    
    $proposed_ref = $date . strtoupper($name[0]) . strtoupper($last_name[0]) . ($dos_count);
    
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
    $agent_assurance = htmlspecialchars($data['agent_assurance']);
    $date_permis = htmlspecialchars($data['date_permis']);
    $date_assurance_payment = htmlspecialchars($data['date_assurance_payment']);
    $vue_status = $_POST['vue_status'];



    $referance = generate_reference($client_first_name, $client_last_name, $dossier_count, $conn);


    $cin_img_recto = $files['cin_img_recto'];
    $cin_img_verso = $files['cin_img_verso'];
    $card_grise_img_recto = $files['card_grise_img_recto'];
    $card_grise_img_verso = $files['card_grise_img_verso'];
    $permis_img_recto = $files['permis_img_recto'];
    $permis_img_verso = $files['permis_img_verso'];


    $upload_dir = '../Stock/documents/F' . $referance;
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }


    $cin_img_recto_path = $upload_dir . '/CIN_R_' . $referance . '.' . pathinfo($cin_img_recto['name'], PATHINFO_EXTENSION);
    $cin_img_verso_path = $upload_dir . '/CIN_V_' . $referance . '.' . pathinfo($cin_img_verso['name'], PATHINFO_EXTENSION);
    $card_grise_img_recto_path = $upload_dir . '/CG_R_' . $referance . '.' . pathinfo($card_grise_img_recto['name'], PATHINFO_EXTENSION);
    $card_grise_img_verso_path = $upload_dir . '/CG_V_' . $referance . '.' . pathinfo($card_grise_img_verso['name'], PATHINFO_EXTENSION);
    $permis_img_recto_path = $upload_dir . '/PERMIS_R_' . $referance . '.' . pathinfo($permis_img_recto['name'], PATHINFO_EXTENSION);
    $permis_img_verso_path = $upload_dir . '/PERMIS_V_' . $referance . '.' . pathinfo($permis_img_verso['name'], PATHINFO_EXTENSION);

    $upload_success = true;


    if (
        !move_uploaded_file($cin_img_recto['tmp_name'], $cin_img_recto_path) ||
        !move_uploaded_file($cin_img_verso['tmp_name'], $cin_img_verso_path)
    ) {
        $upload_success = false;
    }


    if (
        !move_uploaded_file($card_grise_img_recto['tmp_name'], $card_grise_img_recto_path) ||
        !move_uploaded_file($card_grise_img_verso['tmp_name'], $card_grise_img_verso_path)
    ) {
        $upload_success = false;
    }


    if (
        !move_uploaded_file($permis_img_recto['tmp_name'], $permis_img_recto_path) ||
        !move_uploaded_file($permis_img_verso['tmp_name'], $permis_img_verso_path)
    ) {
        $upload_success = false;
    }


    if ($upload_success) {
        return [
            'success' => true,
            'referance' => $referance,
            "consulté" => $vue_status,
            'date_creation' => $date_creation,
            'client_first_name' => $client_first_name,
            'client_last_name' => $client_last_name,
            'phone_number' => $phone_number,
            'email' => $email,
            'cin_number' => $cin_number,
            'card_grise_number' => $card_grise_number,
            'agent_assurance' => $agent_assurance,
            'date_permis' => $date_permis,
            'date_assurance_payment' => $date_assurance_payment,
            'cin_img_recto_path' => $cin_img_recto_path,
            'cin_img_verso_path' => $cin_img_verso_path,
            'card_grise_img_recto_path' => $card_grise_img_recto_path,
            'card_grise_img_verso_path' => $card_grise_img_verso_path,
            'permis_img_recto_path' => $permis_img_recto_path,
            'permis_img_verso_path' => $permis_img_verso_path,
            'message' => 'Form submitted and files uploaded successfully.',
        ];
    } else {
        return [
            'success' => false,
            'message' => 'There was an error uploading the files.',
        ];
    }
}





function insertClientData($data, $conn)
{
    try {
        $id_agent = 1;


        $sql = "INSERT INTO clintes (reference_dos, first_name, last_name, phone, email, CIN, CG, agent_assurance, date_permis, date_assurance_payment, IMG_CIN, IMG_CIN_VERSO, IMG_GC, IMG_GC_VERSO, IMG_PIRMI, IMG_PIRMI_VERSO)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sql1 = "INSERT INTO dossiers (reference, progress, date_creation, id_agent, consulté, charts) VALUES (?, ?, ?, ?, ?, ?)";


        $stmt = $conn->prepare($sql);
        $stmt1 = $conn->prepare($sql1);

        if (!$stmt || !$stmt1) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $charts = date("m/y");

        $stmt->bind_param(
            'ssssssssssssssss',
            $data['referance'],
            $data['client_first_name'],
            $data['client_last_name'],
            $data['phone_number'],
            $data['email'],
            $data['cin_number'],
            $data['card_grise_number'],
            $data['agent_assurance'],
            $data['date_permis'],
            $data['date_assurance_payment'],
            $data['cin_img_recto_path'],
            $data['cin_img_verso_path'],
            $data['card_grise_img_recto_path'],
            $data['card_grise_img_verso_path'],
            $data['permis_img_recto_path'],
            $data['permis_img_verso_path'],
        );

        $progress = 20;
        $stmt1->bind_param(
            'sssiss',
            $data['referance'],
            $progress,
            $data['date_creation'],
            $id_agent,
            $data['vue_status'],
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

// }



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



// Example: Display received data
// echo "<h1>Data Received</h1>";
// echo "<p>First Name: $client_first_name</p>";
// echo "<p>Last Name: $client_last_name</p>";
// echo "<p>Phone Number: $phone_number</p>";
// echo "<p>Email: $email</p>";
// echo "<p>CIN Number: $cin_number</p>";
// echo "<p>Agent Assurance: $agent_assurance</p>";
// echo "<p>Date of Permis Issuance: $date_permis</p>";
// echo "<p>Date of Assurance Payment: $date_assurance_payment</p>";
// echo "<p>CIN Image Path: $cin_img_path</p>";
// echo "<p>Card Grise Image Path: $card_grise_img_path</p>";
// echo "<p>Permis Image Path: $permis_img_path</p>";

?>