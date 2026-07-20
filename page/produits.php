<?php
include('../inc/function.php');
$initiale = get_initiale_user($id_membre); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title><link rel="stylesheet" href="../asset/style.css">
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

        
    <h1>Mes produits</h1>
    <ul>
        <li>Produit :</li>
        <button>Vendre</button>
    </ul>
</body>
</html>