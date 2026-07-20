<?php
session_start();
include('../inc/function.php');

if (isset($_POST['id_produit'], $_POST['prix_vente'], $_POST['quantite'], $_POST['id_membre'])) {
    $id_membre  = $_POST['id_membre'];
    $id_produit = $_POST['id_produit'];
    $prix_vente = $_POST['prix_vente'];
    $quantite   = $_POST['quantite'];
    $date_dispo = date('Y-m-d'); 
    $image = 'default.jpg'; 
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = 'img_' . uniqid() . '.' . $extension; 
        $dossier_destination = '/opt/lampp/htdocs/Exam-S2/asset/images/';
        move_uploaded_file($_FILES['image']['tmp_name'], $dossier_destination . $image);
    }
    vendre_produit($id_produit, $id_membre, $prix_vente, $quantite, $date_dispo, $image);
    header('Location: accueil.php?id_membre=' . $id_membre);
    exit();
}
?>