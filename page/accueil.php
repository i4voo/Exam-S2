<?php
session_start();
include('../inc/function.php');
$produits_a_vendre= produit(1);
$nom_user = get_nom_membre(1);
$user =$nom_user['nom'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
    <ul>
        <li><a href="">Accueil</a></li>
        <li><a href="">Mes produits</a></li>
        <li><a href="">Mes ventes</a></li>
    </ul>
    <div class="topbar-user">
        <div class="topbar-avatar"><? echo $user;?></div>
        Mon compte
      </div>
    </div>
    </nav>
    <h1>Produits a vendre</h1>
    <ul><?php foreach($produits_a_vendre as $p){?>
        <li>Produit : <?php echo $p['nomProduit'];?></li>
        <li> Membre : <?php echo $p['nomMembre'];?></li>
        <li> Quantite : <?php echo $p['quantite_dispo'];?></li>
        <li>Prix Unitaire : <?php echo $p['prix_reference'];?></li>
        <button><a href="achat.php?idProd=<? echo $p['idProdMembre'];?>"><?php if(isset($_SESSION['mess'])){ echo $_SESSION['mess'];}else{ echo "Acheter";}?></a></button>
        <?php } ?>
    </ul>
</body>
</html>