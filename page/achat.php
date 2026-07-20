<?php
session_start();
include('../inc/function.php');
if (isset($_SESSION['id_membre'])) {
    $id_membre = $_SESSION['id_membre'];
}


if(isset($_GET['idProd']) && !empty($_GET['idProd'])) {
    $id = $_GET['idProd'];
    
    $verif_quant = verif_quantite_produit($id);
    
    if($verif_quant == "indispo"){
        $_SESSION['mess'] = "Le produit n'est plus disponible.";
    } 
    else if($verif_quant == "dispo"){
        achat($id);
    }
}

if (isset($_GET['idProd']) && !empty($_GET['idProd'])) {
    $id_produit_membre = $_GET['idProd'];
    $verif = verif_quantite_produit($id_produit_membre);
    if ($verif == "dispo") {
        achat($id_produit_membre);
    } else {
        $_SESSION['mess'] = "Produit indisponible !";
    }
}
header('Location: accueil.php?id_membre=' . $id_membre);
exit();
?>