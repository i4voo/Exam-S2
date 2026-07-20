<?php
include('../inc/function.php');

$id_membre = $_GET['id_membre'];

$initiale = get_initiale_user($id_membre);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

</body>
</html>