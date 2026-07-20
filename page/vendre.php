<?php
include('../inc/function.php');

$id_membre = $_GET['id_membre'];
if (isset($_POST['id_produit'], $_POST['prix_vente'], $_POST['quantite'])) {
    $id_produit = $_POST['id_produit'];
    $prix_vente = $_POST['prix_vente'];
    $quantite = $_POST['quantite'];
    $date_dispo = date('Y-m-d'); 

    vendre_produit($id_produit, $id_membre, $prix_vente, $quantite, $date_dispo);

    header('Location: accueil.php?id_membre=' . $id_membre);
    exit();
}

$nom_user = get_nom_user($id_membre);
$initiale = get_initiale_user($id_membre);
$liste_produits = get_id_produit();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"><link rel="stylesheet" href="../asset/style.css">
    <title>Vendre un produit</title>
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

    <h1>Mettre un produit en vente</h1>

    <form action="vendre.php?id_membre=<?php echo $id_membre; ?>" method="post">
        <p>
            Produit :
            <select name="id_produit" required>
                <?php foreach ($liste_produits as $p) { ?>
                    <option value="<?php echo $p['id_produit']; ?>">
                        <?php echo $p['nom']; ?> (Réf: <?php echo $p['prix_reference']; ?> Ar)
                    </option>
                <?php } ?>
            </select>
        </p>
        <p>Prix de vente : <input type="number" name="prix_vente" required></p>
        <p>Quantité : <input type="number" name="quantite" required></p>
        <button type="submit">Mettre en vente</button>
    </form>

</body>
</html>