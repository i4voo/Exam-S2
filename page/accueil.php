<?php
session_start();
include('../inc/function.php');
if (isset($_GET['id_membre']) && !empty($_GET['id_membre'])) {
    $id_membre = $_GET['id_membre'];
} else {
    $id_membre = 1;
}

$produits_a_vendre = produit($id_membre);
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
            <li><a href="../index.php">Déconnexion</a></li>
        </ul>
        <p>
            <span>[<?php echo $initiale; ?>]</span>
        </p>
    </nav>

    <h1>Produits à vendre</h1>

    <?php if (isset($_SESSION['mess'])) { ?>
        <p style="color: red;"><?php echo $_SESSION['mess']; unset($_SESSION['mess']); ?></p>
    <?php } ?>

    <ul>
        <?php foreach($produits_a_vendre as $p) { ?>
            <li><strong>Produit :</strong> <?php echo $p['nomProduit']; ?></li>   
            <li><strong>Vendeur :</strong> <?php echo $p['nomMembre']; ?></li>
            <li><strong>Quantité :</strong> <?php echo $p['quantite_dispo']; ?></li>
            <li><strong>Prix Unitaire :</strong> <?php echo $p['prix_reference']; ?> Ar</li>
            <a href="achat.php?idProd=<?php echo $p['idProdMembre']; ?>&id_membre=<?php echo $id_membre; ?>">
                <button>Acheter</button>
            </a>
            <br><br>
        <?php } ?>
    </ul>

</body>
</html>