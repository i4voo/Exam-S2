<?php
session_start();
include('../inc/function.php');

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
    modifier_prod($nomProd, $prix, $idcate);
}
}
}

header('Location: ajouter_modifier_prod.php');
exit();