-- Création de la base de données
CREATE DATABASE GestionAccidents;
USE GestionAccidents;

-- Table des agents
CREATE TABLE agents (
    id_agent INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    role ENUM('administrateur', 'expert', 'agent') NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des dossiers
CREATE TABLE dossiers (
    id_dossier INT AUTO_INCREMENT PRIMARY KEY,
    reference VARCHAR(50) UNIQUE NOT NULL,
    date_creation DATE NOT NULL,
    statut ENUM('en cours', 'clôturé', 'abandonné') DEFAULT 'en cours',
    id_agent INT NOT NULL,
    FOREIGN KEY (id_agent) REFERENCES agents(id_agent) ON DELETE CASCADE
);

-- Table des véhicules
CREATE TABLE vehicules (
    id_vehicule INT AUTO_INCREMENT PRIMARY KEY,
    marque VARCHAR(100) NOT NULL,
    modele VARCHAR(100) NOT NULL,
    immatriculation VARCHAR(20) UNIQUE NOT NULL,
    id_dossier INT NOT NULL,
    FOREIGN KEY (id_dossier) REFERENCES dossiers(id_dossier) ON DELETE CASCADE
);

-- Table des documents
CREATE TABLE documents (
    id_document INT AUTO_INCREMENT PRIMARY KEY,
    type_document ENUM('photo', 'devis', 'facture', 'rapport', 'autre') NOT NULL,
    url_document TEXT NOT NULL,
    date_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_dossier INT NOT NULL,
    FOREIGN KEY (id_dossier) REFERENCES dossiers(id_dossier) ON DELETE CASCADE
);

-- Table des devis
CREATE TABLE devis (
    id_devis INT AUTO_INCREMENT PRIMARY KEY,
    montant DECIMAL(10, 2) NOT NULL,
    date_devis DATE NOT NULL,
    statut ENUM('accepté', 'refusé', 'en attente') DEFAULT 'en attente',
    id_dossier INT NOT NULL,
    FOREIGN KEY (id_dossier) REFERENCES dossiers(id_dossier) ON DELETE CASCADE
);

-- Table des réparations
CREATE TABLE reparations (
    id_reparation INT AUTO_INCREMENT PRIMARY KEY,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    nom_garagiste VARCHAR(150) NOT NULL,
    facture DECIMAL(10, 2) NOT NULL,
    id_dossier INT NOT NULL,
    FOREIGN KEY (id_dossier) REFERENCES dossiers(id_dossier) ON DELETE CASCADE
);

-- Table pour l'archivage des dossiers
CREATE TABLE archivage (
    id_archive INT AUTO_INCREMENT PRIMARY KEY,
    reference VARCHAR(50) NOT NULL,
    date_cloture DATE NOT NULL,
    nom_agent VARCHAR(100),
    documents_archives TEXT,
    date_archive TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Ajout d'index pour améliorer les performances
CREATE INDEX idx_reference ON dossiers(reference);
CREATE INDEX idx_immatriculation ON vehicules(immatriculation);
CREATE INDEX idx_type_document ON documents(type_document);

-- Exemple d'insertion d'un agent
INSERT INTO agents (nom, prenom, email, role)
VALUES ('Dupont', 'Jean', 'jean.dupont@example.com', 'agent');

-- Exemple d'insertion d'un dossier
INSERT INTO dossiers (reference, date_creation, statut, id_agent)
VALUES ('ACC-001', '2024-11-21', 'en cours', 1);

-- Exemple d'insertion d'un véhicule
INSERT INTO vehicules (marque, modele, immatriculation, id_dossier)
VALUES ('Toyota', 'Corolla', 'AB-123-CD', 1);

-- Exemple d'insertion de documents
INSERT INTO documents (type_document, url_document, id_dossier)
VALUES ('photo', 'http://example.com/photo1.jpg', 1);

-- Exemple d'insertion d'un devis
INSERT INTO devis (montant, date_devis, statut, id_dossier)
VALUES (1500.00, '2024-11-22', 'en attente', 1);

-- Exemple d'insertion d'une réparation
INSERT INTO reparations (date_debut, date_fin, nom_garagiste, facture, id_dossier)
VALUES ('2024-11-25', '2024-12-05', 'Garage ABC', 1450.00, 1);

-- Requêtes pour archiver un dossier
INSERT INTO archivage (reference, date_cloture, nom_agent, documents_archives)
SELECT 
    d.reference,
    CURRENT_DATE AS date_cloture,
    a.nom AS nom_agent,
    GROUP_CONCAT(documents.url_document) AS documents_archives
FROM dossiers d
JOIN agents a ON d.id_agent = a.id_agent
LEFT JOIN documents ON d.id_dossier = documents.id_dossier
WHERE d.id_dossier = 1
GROUP BY d.id_dossier;