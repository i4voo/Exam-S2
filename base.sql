CREATE DATABASE VENTE_PRODUIT;

-- 1. Table : membre 
CREATE TABLE membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    numero_etu INT,
    nom VARCHAR(100) NOT NULL,
    image_profil VARCHAR(255)
);

-- 2. Table : categorie
CREATE TABLE categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL
);

-- 3. Table : produit
CREATE TABLE produit (
    id_produit INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    id_categorie INT NOT NULL,
    prix_reference INT NOT NULL,
    
    CONSTRAINT fk_produit_categorie 
        FOREIGN KEY (id_categorie) 
        REFERENCES categorie(id_categorie)
        ON DELETE RESTRICT
);

-- 4. Table : produit_membre 
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

-- 5. Table : vente 
CREATE TABLE vente (
    id_vente INT AUTO_INCREMENT PRIMARY KEY,
    id_produit_membre INT NOT NULL,
    date_vente DATE,
    heure TIME,
    quantite INT,
    
    CONSTRAINT fk_vente_pm 
        FOREIGN KEY (id_produit_membre) REFERENCES produit_membre(id_produit_membre)
);

-- INSERTIONS DE DONNÉES

-- INSERTION DES CATEGORIES
INSERT INTO categorie (nom_categorie) VALUES
('Plat'),
('Boisson'),
('Snack'),
('Dessert');

-- INSERTION DES 10 MEMBRES 
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

-- INSERTION DES PRODUITS 
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

-- INSERTION DE 20 PRODUITS A VENDRE (produit_membre)
INSERT INTO produit_membre (id_produit, id_membre, prix_vente, quantite_dispo, date_dispo) VALUES
(1, 1, 8000, 5, '2026-07-20'), 
(2, 2, 4500, 10, '2026-07-20'), 
(3, 3, 7000, 4, '2026-07-20'), 
(4, 4, 1000, 20, '2026-07-20'), 
(5, 5, 1500, 15, '2026-07-20'), 
(6, 6, 2000, 8, '2026-07-20'),  
(7, 7, 1000, 12, '2026-07-20'), 
(8, 8, 1200, 10, '2026-07-20'), 
(9, 9, 3000, 6, '2026-07-20'),  
(10, 10, 2500, 7, '2026-07-20'),
(1, 2, 8500, 3, '2026-07-21'), 
(2, 3, 5000, 8, '2026-07-21'), 
(3, 4, 6500, 5, '2026-07-21'), 
(4, 5, 1000, 15, '2026-07-21'), 
(5, 6, 1200, 10, '2026-07-21'),
(6, 7, 2500, 6, '2026-07-21'), 
(7, 8, 1100, 10, '2026-07-21'),
(8, 9, 1000, 14, '2026-07-21'), 
(9, 10, 2800, 4, '2026-07-21'), 
(10, 1, 2000, 9, '2026-07-21'); 

create or replace view produit_vendre as SELECT m.id_membre as idMembre, p.id_produit as idProd, p.nom as nomProduit, m.nom as nomMembre, quantite_dispo, prix_reference   from produit_membre pm join produit p on pm.id_produit=p.id_produit join membre m on pm.id_membre=m.id_membre;
Select * from vente v join produit_membre pm on v.id_produit_membre=pm.id_produit_membre join produit p on pm.id_produit=p.id_produit;