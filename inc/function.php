<?php
include_once('connect.php');

function checklogin($etu) {
    $bdd = db_connect();
    $req = "SELECT * FROM membre WHERE numero_etu = '$etu'";
    $res = mysqli_query($bdd, $req);
    return mysqli_fetch_assoc($res);
}

function inscription($etu, $nom) {
    $bdd = db_connect();
    mysqli_query($bdd, "INSERT INTO membre (numero_etu, nom) VALUES ('$etu', '$nom')");
    return mysqli_insert_id($bdd);
}

function produit($id) {
    $sql = "SELECT m.id_membre AS idMembre, 
                   p.id_produit AS idProd, 
                   pm.id_produit_membre AS idProdMembre, 
                   p.nom AS nomProduit, 
                   m.nom AS nomMembre, 
                   quantite_dispo, 
                   prix_reference,
                   IFNULL(pm.image, p.image) AS photo_produit
            FROM produit_membre pm 
            JOIN produit p ON pm.id_produit = p.id_produit 
            JOIN membre m ON pm.id_membre = m.id_membre 
            WHERE m.id_membre != '$id' AND pm.quantite_dispo > 0
            ORDER BY pm.id_produit_membre DESC"; 
            
    return get_all_lines($sql);
}

function verif_quantite_produit($id){
    $sql="SELECT quantite_dispo from produit_membre WHERE id_produit_membre='$id'";
    $quant = get_one_line($sql);
    if($quant['quantite_dispo'] > 0){
        return "dispo";
    }else{
        return "indispo";
    }
}

function vendre_produit($id_produit, $id_membre, $prix_vente, $quantite, $date_dispo, $image = 'default.png') {
    $bdd = db_connect();
    if (empty($image)) {
        $image = 'default.png';
    }
    $req = "INSERT INTO produit_membre (id_produit, id_membre, prix_vente, quantite_dispo, date_dispo, image) 
            VALUES ('$id_produit', '$id_membre', '$prix_vente', '$quantite', '$date_dispo', '$image')";       
    return mysqli_query($bdd, $req);
}

function achat($id_produit_membre) {
    $bdd = db_connect();
    $sql1 = "UPDATE produit_membre 
              SET quantite_dispo = quantite_dispo - 1 
              WHERE id_produit_membre = '$id_produit_membre' AND quantite_dispo > 0";
    mysqli_query($bdd, $sql1);
    
    $sql2 = "INSERT INTO vente (id_produit_membre, date_vente, heure, quantite) 
              VALUES ('$id_produit_membre', CURDATE(), CURTIME(), 1)";
    
    $res = mysqli_query($bdd, $sql2);
    if ($res === false) {
        die('Erreur lors de l enregistrement de la vente : ' . mysqli_error($bdd));
    }
}

function ventes($id) {
    $sql = "SELECT p.nom AS produit, 
                   v.quantite, 
                   pm.prix_vente, 
                   (v.quantite * pm.prix_vente) AS total, 
                   CURDATE() AS date_vente
            FROM vente v 
            JOIN produit_membre pm ON v.id_produit_membre = pm.id_produit_membre 
            JOIN produit p ON pm.id_produit = p.id_produit 
            WHERE pm.id_membre = '$id'
            ORDER BY v.id_vente DESC";
            
    return get_all_lines($sql);
}

function get_nom_membre($id){
    $sql="SELECT nom from membre where id_membre='$id'";
    return get_one_line($sql);
}

function get_id_produit(){
    $sql = "SELECT * FROM produit";
    return get_all_lines($sql);
}

function get_one_line($sql){
    $req = mysqli_query(db_connect(), $sql);
    $return = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $return;
}

function get_all_lines($sql){
    $bdd = db_connect();
    $req = mysqli_query($bdd, $sql);
    if ($req === false) {
        die('Erreur SQL dans la requête : ' . mysqli_error($bdd));
    }
    $result = array();
    while ($line = mysqli_fetch_assoc($req)) {
        $result[] = $line;
    }
    
    mysqli_free_result($req);
    return $result;
}

function get_nom_user($id_membre) {
    $bdd = db_connect();
    $res = mysqli_query($bdd, "SELECT nom FROM membre WHERE id_membre = '$id_membre'");
    $user = mysqli_fetch_assoc($res);
    return $user['nom'];
}

function get_initiale_user($id_membre) {
    $nom = get_nom_user($id_membre);
    return strtoupper($nom[0]);
} 

function get_montant_total_ventes($mes_ventes) {
    $montant_total = 0;
    if (!empty($mes_ventes)) {
        foreach ($mes_ventes as $v) {
            $montant_total = $montant_total + $v['total'];
        }
    }
    return $montant_total;
}

function getProduitsFiltres($db, $recherche, $categorie) {
    $conditions = array();
    if ($recherche !== '') {
        $rechercheEscaped = mysqli_real_escape_string($db, $recherche);
        $conditions[] = sprintf("p.nom LIKE '%%%s%%'", $rechercheEscaped);
    }
    if ($categorie !== '') {
        $categorieEscaped = mysqli_real_escape_string($db, $categorie);
        $conditions[] = sprintf("p.id_categorie = '%s'", $categorieEscaped);
    }
    $where = empty($conditions) ? '1=1' : implode(' AND ', $conditions);    
    $sql = "SELECT pm.id_produit_membre AS idProdMembre,
                   p.nom AS nomProduit,
                   m.nom AS nomMembre,
                   pm.quantite_dispo,
                   pm.prix_vente AS prix_reference
            FROM produit_membre pm
            INNER JOIN produit p ON pm.id_produit = p.id_produit
            INNER JOIN membre m ON pm.id_membre = m.id_membre
            WHERE $where AND pm.quantite_dispo > 0
            ORDER BY pm.id_produit_membre DESC";

    return mysqli_query($db, $sql);
} 

function all_categorie(){
    $sql="SELECT p.id_produit as idProd, c.id_categorie as idCate,c.nom_categorie as nomCate, p.nom as nomProd, sum(v.quantite) as quantite, (pm.prix_vente * sum(v.quantite)) as prix FROM vente v JOIN produit_membre pm ON v.id_produit_membre=pm.id_produit_membre 
    JOIN produit p ON pm.id_produit=p.id_produit 
    JOIN categorie c ON p.id_categorie=c.id_categorie group by c.id_categorie";
    return get_all_lines($sql);
}

function info_vente_prod($id){
    $sql="SELECT pm.id_membre as idMembre, p.id_produit as idProd, p.nom as nomProd, sum(v.quantite) as quantite, (pm.prix_vente * sum(v.quantite)) as prix, date_vente 
          FROM vente v 
          JOIN produit_membre pm ON v.id_produit_membre=pm.id_produit_membre 
          JOIN produit p ON pm.id_produit=p.id_produit 
          JOIN categorie c ON p.id_categorie=c.id_categorie 
          WHERE c.id_categorie='$id' 
          GROUP BY p.id_produit";
    return get_all_lines($sql);
}

function info_vente_membre($id){
    $sql="SELECT m.nom as nomMembre, pm.id_membre as idMembre, p.nom as nomProd, sum(v.quantite) as quantite, (pm.prix_vente * sum(v.quantite)) as prix, date_vente 
          FROM vente v 
          JOIN produit_membre pm ON v.id_produit_membre=pm.id_produit_membre 
          JOIN produit p ON pm.id_produit=p.id_produit 
          JOIN membre m ON pm.id_membre=m.id_membre 
          JOIN categorie c ON p.id_categorie=c.id_categorie 
          WHERE p.id_produit ='$id' 
          GROUP BY m.id_membre";
    return get_all_lines($sql);
}

function get_id_categorie($nom){
    $sql="SELECT id_categorie from categorie where nom_categorie='$nom'";
    return get_one_line($sql);
}

function ajouter_prod($nom, $prix, $idcate){
    $sql="INSERT INTO produit (nom, id_categorie, prix_reference) 
          VALUES ('$nom', '$idcate', '$prix')";
    mysqli_query(db_connect(), $sql);
}

function modifier_prod($id_membre, $nom, $prix, $idcate, $perime = 0){
    $bdd = db_connect();
    $sql_get = "SELECT pm.id_produit_membre, pm.id_produit 
                FROM produit_membre pm 
                JOIN produit p ON pm.id_produit = p.id_produit 
                WHERE pm.id_membre = '$id_membre' AND p.nom = '$nom' 
                LIMIT 1";
    $res = get_one_line($sql_get);
    
    if ($res) {
        $idProdMembre = $res['id_produit_membre'];
        $id_produit = $res['id_produit'];
        
        $sql_prod = "UPDATE produit SET nom = '$nom', id_categorie = '$idcate' WHERE id_produit = '$id_produit'";
        mysqli_query($bdd, $sql_prod);
    
        $sql_pm = "UPDATE produit_membre SET prix_vente = '$prix', perime = '$perime' WHERE id_produit_membre = '$idProdMembre'";
        mysqli_query($bdd, $sql_pm);
    }
}
function get_nomcate($id){
    $sql="SELECT nom_categorie from categorie where id_categorie='$id'";
    return get_one_line($sql);
}