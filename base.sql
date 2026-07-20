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