<?php
session_start();
include('../inc/function.php');
$id_membre = $_SESSION['id_membre'];
if (isset($_POST['cate'])) {
$nomCate = $_POST['cate'];
$catData = get_id_categorie($nomCate);
$idcate = isset($catData['id_categorie']) ? $catData['id_categorie'] : null;

if (isset($_POST['choix'])) {
$choix = $_POST['choix'];
$nomProd = $_POST['nomProd'];
$prix = $_POST['prix'];

if ($choix == "Ajouter") {
    ajouter_prod($nomProd, $prix, $idcate);
} else if ($choix == "Modifier") {
    if (isset($_POST['perime'])) {
        $perime = $_POST['perime'];
    } else {
        $perime = 0;
    }
    modifier_prod($id_membre,$nomProd, $prix, $idcate, $perime);
}
}
}

header('Location:ajouter_modifier_prod.php');
exit();