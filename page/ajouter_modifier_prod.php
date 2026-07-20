<?php
session_start();
include('../inc/function.php');
if (isset($_SESSION['id_membre'])) {
$id_membre = $_SESSION['id_membre'];
}
$initiale = get_initiale_user($id_membre);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion des Produits</title>
<!-- Bootstrap 5 CDN -->
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
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card shadow-sm border-0">
<div class="card-header bg-white">
<h4 class="card-title mb-0">Ajouter ou Modifier un Produit</h4>
</div>
<div class="card-body">
<form action="traitement_ajout_modif_prod.php" method="post">
<input type="hidden" name="idProd">

<div class="mb-3">
<label class="form-label">Nom du produit</label>
<input type="text" name="nomProd" class="form-control" placeholder="Ex: Machine à café" required>
</div>

<div class="mb-3">
<label class="form-label">Catégorie</label>
<input type="text" name="cate" class="form-control" placeholder="Ex: Électroménager" required>
</div>

<div class="mb-3">
<label class="form-label">Prix (€)</label>
<input type="number" step="0.01" name="prix" class="form-control" placeholder="0.00" required>
</div>

<div class="d-flex gap-2">
<input type="submit" value="Ajouter" name="choix" class="btn btn-success flex-fill">
<input type="submit" value="Modifier" name="choix" class="btn btn-warning text-white flex-fill">
</div>
</form>
</div>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>