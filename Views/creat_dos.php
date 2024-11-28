<style>
    h1 {
        margin-bottom: 30px;
        font-size: 2rem;
        font-weight: bold;
        color: #343a40;
    }

    label {
        font-weight: 500;
        margin-bottom: 5px;
        display: inline-block;
    }

    .btn-send {
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        width: 100%;
        padding: 10px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #f8f9fa;
    }

    .card-header {
        background-color: #343a40;
        color: #fff;
        border-radius: 10px 10px 0 0;
        padding: 15px;
        font-weight: bold;
        font-size: 1.25rem;
    }

    .form-control,
    .form-select {
        border-radius: 5px;
        border: 1px solid #ced4da;
        padding: 10px;
        font-size: 0.9rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .text-center h1 {
        font-size: 1.75rem;
        font-weight: bold;
        color: #495057;
    }

    .text-muted {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4 text-center">Dossier</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="index.php?page=index">Dashboard</a></li>
            </ol>

            <div class="card mb-4">
                <div class="card-body">
                    <?php
                    if (isset($_GET['action'])) {
                        ?>
                        <div class="container">
                            <div class="text-center mt-4">
                                <h1>Créer un nouveau véhicule</h1>
                                <b class="text-muted">Veuillez remplir les informations du véhicule</b>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="card mt-4 p-4">
                                        <div class="card-body">
                                            <form id="vehicle-form" role="form" action="../Models/controller.php"
                                                method="POST" enctype="multipart/form-data">
                                                <!-- Marque du véhicule -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6 col-12">
                                                        <label for="marque">Marque *</label>
                                                        <input id="marque" type="text" name="marque" class="form-control"
                                                            placeholder="Entrez la marque du véhicule" required>
                                                    </div>
                                                </div>

                                                <!-- Modèle du véhicule -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6 col-12">
                                                        <label for="modele">Modèle *</label>
                                                        <input id="modele" type="text" name="modele" class="form-control"
                                                            placeholder="Entrez le modèle du véhicule" required>
                                                    </div>
                                                </div>

                                                <!-- Immatriculation du véhicule -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6 col-12">
                                                        <label for="immatriculation">Numéro d'immatriculation *</label>
                                                        <input id="immatriculation" type="text" name="immatriculation"
                                                            class="form-control"
                                                            placeholder="Entrez le numéro d'immatriculation" required>
                                                    </div>
                                                </div>

                                                <!-- ID Dossier (hidden or from session) -->
                                                <input type="hidden" name="id_dossier" value="<?php echo $id_dossier; ?>">

                                                <!-- Submit Button -->
                                                <div class="text-center">
                                                    <button type="submit" name="vehicle_info"
                                                        class="btn btn-success btn-send">Soumettre</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    } else {
                        ?>

                        <!-- -------------------------------------------------------------------------------------------------------- -->

                        <div class="container">
                            <div class="text-center mt-4">
                                <h1>Créer un nouveau dossier</h1>
                                <b class="text-muted">Veuillez remplir le client information</b>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="card mt-4 p-4">
                                        <div class="card-body">
                                            <form id="contact-form" role="form" action="../Models/controller.php"
                                                method="POST" enctype="multipart/form-data">
                                                <!-- Nom et coordonnées du client -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6 col-12">
                                                        <label for="client_first_name">Prénom *</label>
                                                        <input id="client_first_name" type="text" name="client_first_name"
                                                            class="form-control" placeholder="Entrez le prénom du client"
                                                            required>
                                                    </div>
                                                    <div class="col-md-6 col-12 mt-md-0 mt-3">
                                                        <label for="client_last_name">Nom *</label>
                                                        <input id="client_last_name" type="text" name="client_last_name"
                                                            class="form-control" placeholder="Entrez le nom du client"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6 col-12">
                                                        <label for="phone_number">Numéro de téléphone *</label>
                                                        <input id="phone_number" type="text" name="phone_number"
                                                            class="form-control"
                                                            placeholder="Entrez le numéro de téléphone du client" required>
                                                    </div>
                                                    <div class="col-md-6 col-12 mt-md-0 mt-3">
                                                        <label for="email">Email *</label>
                                                        <input id="email" type="email" name="email" class="form-control"
                                                            placeholder="Entrez l'email du client" required>
                                                    </div>
                                                </div>

                                                <!-- Détails du CIN -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6 col-12">
                                                        <label for="cin_number">CIN (Numéro d'identité) *</label>
                                                        <input id="cin_number" type="text" name="cin_number"
                                                            class="form-control" placeholder="Entrez le numéro de CIN"
                                                            required>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6 col-12">
                                                            <label for="cin_img_recto">
                                                                <i class="fas fa-id-card"></i> Image CIN Recto *
                                                            </label>
                                                            <input id="cin_img_recto" type="file" name="cin_img_recto"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="col-md-6 col-12 mt-md-0 mt-3">
                                                            <label for="cin_img_verso">
                                                                <i class="fas fa-id-card-alt"></i> Image CIN Verso *
                                                            </label>
                                                            <input id="cin_img_verso" type="file" name="cin_img_verso"
                                                                class="form-control" required>
                                                        </div>
                                                    </div>

                                                </div>

                                                <!-- Carte grise -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6 col-12">
                                                        <label for="card_grise_number">Numéro de carte grise *</label>
                                                        <input id="card_grise_number" type="text" name="card_grise_number"
                                                            class="form-control"
                                                            placeholder="Entrez le numéro de la carte grise" required>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6 col-12">
                                                            <label for="card_grise_img_recto">
                                                                <i class="fas fa-id-card"></i> Image Carte Grise Recto *
                                                            </label>
                                                            <input id="card_grise_img_recto" type="file"
                                                                name="card_grise_img_recto" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-6 col-12 mt-md-0 mt-3">
                                                            <label for="card_grise_img_verso">
                                                                <i class="fas fa-id-card-alt"></i> Image Carte Grise Verso *
                                                            </label>
                                                            <input id="card_grise_img_verso" type="file"
                                                                name="card_grise_img_verso" class="form-control" required>
                                                        </div>
                                                    </div>

                                                </div>

                                                <!-- Nom de l'agent d'assurance -->
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <label for="agent_assurance">Nom de l'agent d'assurance *</label>
                                                        <select id="agent_assurance" name="agent_assurance"
                                                            class="form-control" required>
                                                            <option value="">-- Sélectionnez un agent d'assurance --
                                                            </option>
                                                            <option value="agent1">Agent 1</option>
                                                            <option value="agent2">Agent 2</option>
                                                            <option value="agent3">Agent 3</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Détails du permis -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6 col-12">
                                                        <label for="date_permis">Date de délivrance du permis *</label>
                                                        <input id="date_permis" type="date" name="date_permis"
                                                            class="form-control" required>
                                                    </div>
                                                    <!-- Permis Recto and Verso -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-6 col-12">
                                                            <label for="permis_img_recto">Permis Recto *</label>
                                                            <input id="permis_img_recto" type="file" name="permis_img_recto"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="col-md-6 col-12 mt-md-0 mt-3">
                                                            <label for="permis_img_verso">Permis Verso *</label>
                                                            <input id="permis_img_verso" type="file" name="permis_img_verso"
                                                                class="form-control" required>
                                                        </div>
                                                    </div>

                                                </div>

                                                <!-- Détails du paiement de l'assurance -->
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <label for="date_assurance_payment">Date de paiement de l'assurance
                                                            *</label>
                                                        <input id="date_assurance_payment" type="date"
                                                            name="date_assurance_payment" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-1"></div>
                                                    <div class="col-2">
                                                        <b>Vue</b>
                                                        <input type="radio" name="vue_status" value="1" required>
                                                    </div>
                                                    <div class="col-2">
                                                        <b>Non Vue</b>
                                                        <input type="radio" name="vue_status" value="0" required>
                                                    </div>
                                                </div>


                                                <!-- Bouton de soumission -->
                                                <div class="text-center">
                                                    <button type="submit" name="client_info"
                                                        class="btn btn-success btn-send">Soumettre</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
    <?php include "components/footer.html"; ?>
</div>