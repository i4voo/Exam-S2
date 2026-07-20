<?php
session_start();
include('../inc/function.php');

if (isset($_SESSION['id_membre'])) {
    $id_membre = $_SESSION['id_membre'];
} else {
    $id_membre = 1;
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