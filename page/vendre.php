<?php
session_start();
include('../inc/function.php');

if (isset($_SESSION['id_membre'])) {
$id_membre = $_SESSION['id_membre'];
} elseif (isset($_GET['id_membre']) && !empty($_GET['id_membre'])) {
$id_membre = $_GET['id_membre'];
} else {
$id_membre = 1; 
}

$initiale = get_initiale_user($id_membre);
$liste_produits = get_id_produit();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Vendre un produit</title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
<div class="container">
<a class="navbar-brand fw-bold text-success" href="accueil.php?id_membre=<?php echo $id_membre; ?>">IT Mivarotra</a>
<div class="collapse navbar-collapse">
<ul class="navbar-nav me-auto">
<li class="nav-item"><a class="nav-link" href="accueil.php?id_membre=<?php echo $id_membre; ?>">Accueil</a></li>
<li class="nav-item"><a class="nav-link active" href="vendre.php?id_membre=<?php echo $id_membre; ?>">Vendre un produit</a></li>
<li class="nav-item"><a class="nav-link" href="ventes.php?id_membre=<?php echo $id_membre; ?>">Mes ventes</a></li>
<li class="nav-item"><a class="nav-link active" href="statistique.php?id_membre=<?php echo $id_membre; ?>">Statistiques</a></li>
<li class="nav-item"><a class="nav-link text-warning" href="../index.php">Déconnexion</a></li>
</ul>
<span class="badge bg-success fs-6 rounded-circle p-2"><?php echo $initiale; ?></span>
</div>
</div>
</nav>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card shadow-sm border-0">
<div class="card-header bg-success text-white py-3">
<h3 class="h5 mb-0 fw-bold">Mettre un produit en vente</h3>
</div>
<div class="card-body p-4">
<form action="traitement_vendre.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id_membre" value="<?php echo $id_membre; ?>">

<div class="mb-3">
<label for="id_produit" class="form-label fw-bold">Produit :</label>
<select name="id_produit" id="id_produit" class="form-select" required>
<?php foreach ($liste_produits as $p) { ?>
    <option value="<?php echo $p['id_produit']; ?>">
        <?php echo $p['nom']; ?> (Réf: <?php echo $p['prix_reference']; ?> Ar)
    </option>
<?php } ?>
</select>
</div>

<div class="mb-3">
    <label for="prix_vente" class="form-label fw-bold">Prix de vente (Ar) :</label>
    <input type="number" name="prix_vente" id="prix_vente" class="form-control" required>
</div>

<div class="mb-3">
    <label for="quantite" class="form-label fw-bold">Quantité :</label>
    <input type="number" name="quantite" id="quantite" class="form-control" required>
</div>

<div class="mb-4">
    <label for="image" class="form-label fw-bold">Photo du produit (optionnel) :</label>
    <input type="file" name="image" id="image" class="form-control" accept="image/*">
</div>

<button type="submit" class="btn btn-success w-100 py-2 fw-bold">Mettre en vente</button>
</form>
</div>
</div>
</div>
</div>
</div>

</body>
</html>