CREATE DATABASE VENTE_PRODUIT;

CREATE TABLE membre (
);

CREATE TABLE categorie (
);

CREATE TABLE membre (
);


CREATE TABLE produit_membre (
    id_produit_membre INT AUTO_INCREMENT PRIMARY KEY,
    id_produit INT,
    id_membre INT,
    prix_vente INT,
    quantite_dispo INT,
    date_dispo DATE,
    CONSTRAINT fk_produit FOREIGN KEY (id_produit) REFERENCES produit(id_produit),
    CONSTRAINT fk_membre FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);


CREATE TABLE vente (
    id_vente INT AUTO_INCREMENT PRIMARY KEY,
    date_vente DATE,
    heure TIME,
    id_produit_membre INT,
    quantite INT,
    CONSTRAINT fk_produit_membre FOREIGN KEY (id_produit_membre) REFERENCES produit_membre(id_produit_membre)
);



