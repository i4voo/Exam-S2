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
function ajouter_produit($nom, $quantite, $prix, $id_membre) {
    $bdd = db_connect();
    mysqli_query($bdd, "INSERT INTO produit (nom_produit, quantite, prix_unitaire, id_membre) VALUES ('$nom', '$quantite', '$prix', '$id_membre')");
}
function produit_membre(){

} 
function verif_quantite_produit(){

} 

function vendre_produit($id_produit, $id_membre, $prix_vente, $quantite, $date_dispo){
    $bdd = db_connect();
    $req = "INSERT INTO produit_membre (id_produit, id_membre, prix_vente, quantite_dispo, date_dispo) 
            VALUES ('$id_produit', '$id_membre', '$prix_vente', '$quantite', '$date_dispo')";
    return mysqli_query($bdd, $req);
}
function ventes(){

}
function get_id_membre(){
    
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
    if (!$req) {
        die('Erreur SQL : ' . mysqli_error($bdd));
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