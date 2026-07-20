<?php
include_once('connect.php');

function login($etu){

}

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

function acheter_produit(){

}
function produit($id){
    $sql = "SELECT pm.id_produit_membre AS idProdMembre, p.nom AS nomProduit, m.nom AS nomMembre, pm.quantite_dispo, pm.prix_vente AS prix_reference FROM produit_membre pm JOIN produit p ON pm.id_produit = p.id_produit JOIN membre m ON pm.id_membre = m.id_membre WHERE pm.quantite_dispo > 0 ORDER BY pm.id_produit_membre DESC"; 
            
    return get_all_lines($sql);
}
function produit_membre(){

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

function vendre_produit($id_produit, $id_membre, $prix_vente, $quantite, $date_dispo) {
    $bdd = db_connect();
    
    $req = "INSERT INTO produit_membre (id_produit, id_membre, prix_vente, quantite_dispo, date_dispo) 
            VALUES ('$id_produit', '$id_membre', '$prix_vente', '$quantite', '$date_dispo')";
            
    return mysqli_query($bdd, $req);
}
function achat($id_produit_membre) {
    $bdd = db_connect();
    $sql1 = "UPDATE produit_membre 
              SET quantite_dispo = quantite_dispo - 1 
              WHERE id_produit_membre = '$id_produit_membre' AND quantite_dispo > 0";
    mysqli_query($bdd, $sql1);
    $sql2 = "INSERT INTO vente (id_produit_membre, heure, quantite) 
              VALUES ('$id_produit_membre', CURTIME(), 1)";
    
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

function get_id_produit_membre(){

} 


function get_one_line($sql){
    $req=mysqli_query(db_connect(),$sql);
    $return=mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $return;
}
function get_all_lines($sql){
    $bdd = db_connect();
    $req = mysqli_query($bdd, $sql);
    if ($req === false) {
        die('Erreur SQL dans la requête : ' . mysqli_error($bdd));}
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