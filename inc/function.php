<?php
include_once('connect.php');
function get_all_lines($sql){
    $req = mysqli_query(db_connect(),$sql );
    if (!$req) {
        die('Erreur SQL : ' . mysqli_error(dbconnect()));
    }
    $result = array();
    while ($line = mysqli_fetch_assoc($req)) {
        $result[] = $line;
    }
    mysqli_free_result($req);
    return $result;
}

function get_one_line($sql){
    $req = mysqli_query(db_connect(),$sql );
    if (!$req) {
        die('Erreur SQL : ' . mysqli_error(dbconnect()));
    }
    $result = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $result;
}

function login($etu){

}

function checklogin($etu){

}

function inscription($etu){

}
function acheter_produit(){

}
function produit($id){
    $sql="SELECT m.id_membre as idMembre, p.id_produit as idProd, p.nom as nomProduit, m.nom as nomMembre, quantite_dispo, prix_reference   from produit_membre pm join produit p on pm.id_produit=p.id_produit join membre m on pm.id_membre=m.id_membre where m.id_membre!='$id'";
    return get_all_lines($sql);
    
} 
function produit_membre(){

} 
function verif_quantite_produit(){

}
function vendre_produit($id){

} 
function ventes(){
    $sql="SELECT  FROM vente";
}
function get_nom_membre($id){
    $sql="SELECT nom from membre where id_membre='$id'";
    return get_one_line($sql);
}
function get_id_produit(){

}function get_id_produit_membre(){

} 
