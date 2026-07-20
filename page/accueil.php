<?php
include('../inc/function.php');
$produits_a_vendre= produit(1);
$initiale = get_initiale_user($id_membre); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/style.css">
    <title>Accueil</title>
</head>
<body>

    <nav>
        <ul>
            <li><a href="accueil.php?id_membre=<?php echo $id_membre; ?>">Accueil</a></li>
            <li><a href="vendre.php?id_membre=<?php echo $id_membre; ?>">Vendre un produit</a></li>
            <li><a href="ventes.php?id_membre=<?php echo $id_membre; ?>">Mes ventes</a></li>
            <li><a href="index.php">Déconnexion</a></li>
        </ul>
        <p>
            <span>[<?php echo $initiale; ?>]</span>
        </p>
    </nav>

    <h1>Produits à vendre</h1>

    <table border="1">
        <tr>
            <th>Produit</th>
            <th>Membre</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>Exemple produit</td>
            <td>Exemple membre</td>
            <td>1</td>
            <td>1000 Ar</td>
            <td><button>Acheter</button></td>
        </tr>
    </table>
<<<<<<< HEAD

=======
    <ul><?php foreach($produits_a_vendre as $p){?>
        <li>Produit : <?php echo $p['nomProduit'];?></li>
        <li> Membre : <?php echo $p['nomMembre'];?></li>
        <li> Quantite : <?php echo $p['quantite_dispo'];?></li>
        <li>Prix Unitaire : <?php echo $p['prix_reference'];?></li>
        <button><a href="achat.php?idProd =<? echo $p['idProd'];?>">Acheter</a></button>
        <?php } ?>
    </ul>
>>>>>>> origin/Iavo-V1-backend
</body>
</html>