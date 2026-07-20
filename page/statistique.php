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
$categorie = all_categorie();
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
<a class="navbar-brand fw-bold text-success" href="#">IT Mivarotra</a>
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
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card border-0 shadow-sm">
<div class="card-header bg-white py-3">
<h3 class="mb-0 fw-bold text-dark">Ventes par Catégorie</h3>
</div>
<div class="card-body p-4">
<p class="text-muted mb-4">Sélectionnez une catégorie pour consulter la répartition des ventes :</p>
<div class="list-group">
<table class="table table-hover mb-0">
<thead class="table-dark">
        <tr>
            <th>Catégorie</th>
            <th>Quantités</th>
            <th>Prix total</th>
        </tr>
</thead>
<tbody>
<?php foreach($categorie as $c){ ?>
    <tr>
        <td><a href="info_vente_produit.php?id_cat=<?php echo $c['idCate'];?>&id_membre=<?php echo $id_membre; ?>" class="fw-bold text-decoration-none text-success""><?php echo htmlspecialchars($c['nomCate']);?></a></td>
        <td><?php echo htmlspecialchars($c['quantite']);?></td>
        <td><?php echo htmlspecialchars($c['prix']);?></td>
    </tr>
   
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>