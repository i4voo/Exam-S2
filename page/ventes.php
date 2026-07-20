<?php
include('../inc/function.php');

if (isset($_GET['id_membre'])) {
    $id_membre = $_GET['id_membre'];
} else {
    $id_membre = 1; 
}

$initiale = get_initiale_user($id_membre);
$mes_ventes = ventes($id_membre);
$montant_total = get_montant_total_ventes($mes_ventes);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Ventes</title>
    <link rel="stylesheet" href="../asset/style.css">
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
            <span><?php echo $initiale; ?></span>
        </p>
    </nav>

    <h1>Mes ventes</h1>

    <h2>Total des gains : <?php echo $montant_total; ?> Ar</h2>

    <table>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Total</th>
            <th>Date</th>
        </tr>
        <?php if (!empty($mes_ventes)) { ?>
            <?php foreach ($mes_ventes as $v) { ?>
                <tr>
                    <td><?php echo $v['produit']; ?></td>
                    <td><?php echo $v['quantite']; ?></td>
                    <td><?php echo $v['prix_vente']; ?> Ar</td>
                    <td><?php echo $v['total']; ?> Ar</td>
                    <td><?php echo $v['date_vente']; ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5">Aucune vente effectuée pour le moment.</td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>