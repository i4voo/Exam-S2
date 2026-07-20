CREATE DATABASE VENTE_PRODUIT ;

CREATE TABLE membre (
    numero_etu INT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    image_profil VARCHAR(255)
);

CREATE TABLE categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL
);

CREATE TABLE produit (
    id_produit INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    id_categorie INT NOT NULL,
    prix_reference  INT NOT NULL,
    
    CONSTRAINT fk_produit_categorie 
        FOREIGN KEY (id_categorie) 
        REFERENCES categorie(id_categorie)
        ON DELETE RESTRICT
);


-- Table : produit_membre 
CREATE TABLE produit_membre (
    id_produit_membre INT AUTO_INCREMENT PRIMARY KEY,
    id_produit INT NOT NULL,
    id_membre INT NOT NULL,
    prix_vente INT,
    quantite_dispo INT,
    date_dispo DATE,
    CONSTRAINT fk_pm_produit 
        FOREIGN KEY (id_produit) REFERENCES produit(id_produit),
    CONSTRAINT fk_pm_membre 
        FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

-- Table : vente 
CREATE TABLE vente (
    id_vente INT AUTO_INCREMENT PRIMARY KEY,
    id_produit_membre INT NOT NULL,
    date DATE,
    heure TIME,
    quantite INT,
    CONSTRAINT fk_vente_pm 
        FOREIGN KEY (id_produit_membre) REFERENCES produit_membre(id_produit_membre)
);

-- INSERTION DES CATEGORIES
INSERT INTO categorie (nom_categorie) VALUES
('Plat'),
('Boisson'),
('Snack'),
('Dessert');

--INSERTION DE 10 MEMBRES 
INSERT INTO membre (numero_etu, nom, image_profil) VALUES
(5045, 'Jean Dupont', 'profil_5045.jpg'),
(5046, 'Marie Curie', 'profil_5046.jpg'),
(5047, 'Lucas Martin', 'profil_5047.jpg'),
(5048, 'Emma Bernard', 'profil_5048.jpg'),
(5049, 'Thomas Petit', 'profil_5049.jpg'),
(5050, 'Chloé Robert', 'profil_5050.jpg'),
(5051, 'Hugo Richard', 'profil_5051.jpg'),
(5052, 'Lea Dubois', 'profil_5052.jpg'),
(5053, 'Enzo Moreau', 'profil_5053.jpg'),
(5054, 'Manon Laurent', 'profil_5054.jpg');

-- PRODUITS 
INSERT INTO produit (nom, id_categorie, prix_reference) VALUES
('Burger Maison', 1, 8050),
('Sandwich Poulet', 1, 5000),
('Pâtes Bolognaise', 1, 7000),
('Eau Minérale 50cl', 2, 1000),
('Soda Canette 33cl', 2, 1080),
('Jus d''Orange', 2, 2020),
('Chips Nature', 3, 1050),
('Barre Céréales', 3, 1020),
('Tarte aux Pommes', 4, 3000),
('Mousse au Chocolat', 4, 2050);