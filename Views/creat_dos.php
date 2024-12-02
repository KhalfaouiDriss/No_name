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
                    if (isset($_GET['action']) && $_GET['action'] == 'car_info') {
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
                    } else if (isset($_GET['action']) && $_GET['action'] == 'remarque') {
                        ?>
                            <div class="container">
                                <div class="text-center mt-4">
                                    <h1>Donner Votre Avis</h1>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="card mt-4 p-4">
                                            <div class="card-body">
                                                <form id="remark-form" role="form" action="../Models/controller.php"
                                                    method="POST" enctype="multipart/form-data">
                                                    <!-- Vue or Non Vue Selection -->
                                                    <div class="row mb-3">
                                                        <div class="col-1"></div>
                                                        <div class="col-2">
                                                            <b>Vue</b>
                                                            <input type="radio" id="vue" name="vue_status" value="1" required>
                                                        </div>
                                                        <div class="col-2">
                                                            <b>Non Vue</b>
                                                            <input type="radio" id="non_vue" name="vue_status" value="0"
                                                                required>
                                                        </div>
                                                    </div>

                                                    <!-- File Upload (conditional) -->
                                                    <div class="mb-3" id="file-upload-container" style="display: none;">
                                                        <label for="annulation_letter" class="form-label">Lettre d'Annulation
                                                            *</label>
                                                        <input type="file" id="annulation_letter" name="annulation_letter"
                                                            class="form-control" accept=".pdf,.txt" />
                                                    </div>

                                                    <!-- Remarque -->
                                                    <div class="mb-3">
                                                        <label for="remark" class="form-label">Votre Remarque *</label>
                                                        <textarea id="remark" name="remark" class="form-control" rows="5"
                                                            placeholder="Écrivez votre remarque ici..." required></textarea>
                                                    </div>

                                                    <!-- Submit Button -->
                                                    <div class="text-center">
                                                        <button type="submit" name="submit_remark"
                                                            class="btn btn-success btn-send">
                                                            Soumettre
                                                        </button>
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
                                    <b class="text-muted">Veuillez remplir les informations du client</b>
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

                                                    <!-- Détails du numéro de châssis -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-6 col-12">
                                                            <label for="vin_number">Le numéro de châssis (code VIN) *</label>
                                                            <input id="vin_number" type="text" name="vin_number"
                                                                class="form-control"
                                                                placeholder="Entrez le numéro de châssis (code VIN)" required>
                                                        </div>
                                                    </div>

                                                    <!-- Images du code VIN -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-6 col-12">
                                                            <label for="VIN_img_recto">Code VIN Recto *</label>
                                                            <input id="VIN_img_recto" type="file" name="VIN_img_recto"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="col-md-6 col-12 mt-md-0 mt-3">
                                                            <label for="VIN_img_verso">Code VIN Verso *</label>
                                                            <input id="VIN_img_verso" type="file" name="VIN_img_verso"
                                                                class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <!-- Date de l'accident -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-6 col-12">
                                                            <label for="accident_date">Date de l'accident *</label>
                                                            <input id="accident_date" type="date" name="accident_date"
                                                                class="form-control" required>
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