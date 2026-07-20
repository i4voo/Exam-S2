<?php

include('../inc/function.php');
$nomCate=$_POST['nom'];
$idcate= get_id_categorie($nomCate)
if(isset($_POST['choix'])){
    $choix=$_POST['choix'];
    if($choix=="Ajouter"){
        ajouter_prod($_POST['nomProd'], $_POST['prix'], $idcate);
    }else if($choix=="Modifier"){
        modifier_prod($_POST['nomProd'], $_POST['prix'], $idcate);
    }
}
header('Location:ajouter_modifier_prod.php');