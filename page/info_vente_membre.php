<?php
session_start();
include('../inc/function.php');
if (isset($_SESSION['id_membre'])) {
$id_membre = $_SESSION['id_membre'];
}
$initiale = get_initiale_user($id_membre);
$id_pro = isset($_GET['idProd']) ? $_GET['idProd'] : 0;
$info_vente_membre = info_vente_membre($id_pro);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Statistiques par Catégorie - IT Mivarotra</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
<div class="container">
<a class="navbar-brand fw-bold text-success" href="accueil.php?id_membre=<?php echo $id_membre; ?>">IT Mivarotra</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav me-auto">
<li class="nav-item"><a class="nav-link" href="accueil.php?id_membre=<?php echo $id_membre; ?>">Accueil</a></li>
<li class="nav-item"><a class="nav-link" href="vendre.php?id_membre=<?php echo $id_membre; ?>">Vendre un produit</a></li>
<li class="nav-item"><a class="nav-link" href="ventes.php?id_membre=<?php echo $id_membre; ?>">Mes ventes</a></li>
<li class="nav-item"><a class="nav-link active" href="statistique.php?id_membre=<?php echo $id_membre; ?>">Statistiques</a></li>
<li class="nav-item"><a class="nav-link text-warning" href="../index.php">Déconnexion</a></li>
</ul>
<span class="badge bg-success fs-6 rounded-circle p-2"><?php echo $initiale; ?></span>
</div>
</div>
</nav>

<div class="container">
<div class="card shadow-sm border-0">
<div class="card-header bg-white d-flex justify-content-between align-items-center">
<h4 class="mb-0">Vente par membre</h4>
<a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm">← Retour</a>
</div>
<div class="card-body p-0">
<div class="table-responsive">
<table class="table table-hover table-striped mb-0">
<thead class="table-dark">
<tr>
    <th>Membre</th>
    <th>Produit</th>
    <th>Quantité</th>
    <th>Revenu total</th>
</tr>
</thead>
<tbody>
<?php if (!empty($info_vente_membre)): ?>
    <?php foreach($info_vente_membre as $i): ?>
    <tr>
        <td><span class="fw-semibold"><?php echo $i['nomMembre']; ?></span></td>
        <td><?php echo $i['nomProd']; ?></td>
        <td><?php echo $i['quantite']; ?></td>
        <td><?php echo $i['prix']; ?></td>
    </tr>
    
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="3" class="text-center text-muted p-3">Aucune donnée trouvée.</td></tr>
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