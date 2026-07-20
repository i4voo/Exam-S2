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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Mes Ventes</title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
<div class="container">
<a class="navbar-brand fw-bold text-success" href="accueil.php?id_membre=<?php echo $id_membre; ?>">IT Mivarotra</a>
<div class="collapse navbar-collapse">
<ul class="navbar-nav me-auto">
<li class="nav-item"><a class="nav-link" href="accueil.php?id_membre=<?php echo $id_membre; ?>">Accueil</a></li>
<li class="nav-item"><a class="nav-link" href="vendre.php?id_membre=<?php echo $id_membre; ?>">Vendre un produit</a></li>
<li class="nav-item"><a class="nav-link active" href="ventes.php?id_membre=<?php echo $id_membre; ?>">Mes ventes</a></li>
<li class="nav-item"><a class="nav-link active" href="statistique.php?id_membre=<?php echo $id_membre; ?>">Statistiques</a></li>
<li class="nav-item"><a class="nav-link text-warning" href="../index.php">Déconnexion</a></li>
</ul>
<span class="badge bg-success fs-6 rounded-circle p-2"><?php echo $initiale; ?></span>
</div>
</div>
</nav>

<div class="container">

<div class="d-flex justify-content-between align-items-center mb-4">
<h1 class="h3 text-dark fw-bold mb-0">Historique de mes ventes</h1>
<div class="card bg-success text-white shadow-sm border-0">
<div class="card-body py-2 px-3">
<span class="fs-6">Total des gains : </span>
<span class="fs-4 fw-bold"><?php echo $montant_total; ?> Ar</span>
</div>
</div>
</div>

<div class="card border-0 shadow-sm">
<div class="card-body p-0">
<table class="table table-hover align-middle mb-0">
<thead class="table-dark">
<tr>
    <th>Produit</th>
    <th>Quantité</th>
    <th>Prix Unitaire</th>
    <th>Total</th>
    <th>Date</th>
</tr>
</thead>
<tbody>
<?php if (!empty($mes_ventes)) { ?>
<?php foreach ($mes_ventes as $v) { ?>
    <tr>
        <td class="fw-bold text-dark"><?php echo $v['produit']; ?></td>
        <td><span class="badge bg-secondary"><?php echo $v['quantite']; ?></span></td>
        <td><?php echo $v['prix_vente']; ?> Ar</td>
        <td class="text-success fw-bold"><?php echo $v['total']; ?> Ar</td>
        <td class="text-muted"><?php echo $v['date_vente']; ?></td>
    </tr>
<?php } ?>
<?php } else { ?>
<tr>
    <td colspan="5" class="text-center py-4 text-muted">Aucune vente effectuée pour le moment.</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>

</div>

</body>
</html>