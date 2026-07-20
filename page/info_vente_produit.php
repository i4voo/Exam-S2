<?php
session_start();
include('../inc/function.php');
if (isset($_SESSION['id_membre'])) {
$id_membre = $_SESSION['id_membre'];
}
$initiale = get_initiale_user($id_membre);
$id_cat = isset($_GET['id_cat']) ? $_GET['id_cat'] : 0;
$info_vente_prod = info_vente_prod($id_cat);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produits Vendus</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
<div class="container">
<a class="navbar-brand fw-bold" href="#">Plateforme Ventes</a>
<div class="collapse navbar-collapse">
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
<li class="nav-item"><a class="nav-link" href="accueil.php?id_membre=<?php echo $id_membre; ?>">Accueil</a></li>
<li class="nav-item"><a class="nav-link" href="vendre.php?id_membre=<?php echo $id_membre; ?>">Vendre un produit</a></li>
<li class="nav-item"><a class="nav-link" href="ventes.php?id_membre=<?php echo $id_membre; ?>">Mes ventes</a></li>
<li class="nav-item"><a class="nav-link" href="statistique.php?id_membre=<?php echo $id_membre; ?>">Statistiques</a></li>
<li class="nav-item"><a class="nav-link text-warning" href="../index.php">Déconnexion</a></li>
</ul>
<span class="badge bg-light text-primary fs-6">[<?php echo $initiale; ?>]</span>
</div>
</div>
</nav>

<div class="container">
<div class="card shadow-sm border-0">
<div class="card-header bg-white d-flex justify-content-between align-items-center">
<h4 class="mb-0">Produits par Catégorie</h4>
<a href="statistique.php" class="btn btn-outline-secondary btn-sm">← Choisir une autre catégorie</a>
</div>
<div class="card-body p-0">
<div class="table-responsive">
<table class="table table-hover mb-0">
<thead class="table-dark">
<tr>
<th>Nom du Produit</th>
<th>Quantité Vendue</th>
</tr>
</thead>
<tbody>
<?php if (!empty($info_vente_prod)): ?>
<?php foreach($info_vente_prod as $i): ?>
<tr>
    <td>
        <a href="info_vente_membre.php?idProd=<?php echo $i['idProd'];?>" class="fw-bold text-decoration-none">
            <?php echo $i['nomProd'];?>
        </a>
    </td>
    <td><span class="badge bg-primary"><?php echo $i['quantite'];?></span></td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr><td colspan="2" class="text-center text-muted p-3">Aucun produit vendu dans cette catégorie.</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>