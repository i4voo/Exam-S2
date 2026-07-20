<?php
session_start();
include('../inc/function.php');

$db = db_connect();

if (isset($_SESSION['id_membre'])) {
$id_membre = $_SESSION['id_membre'];
}
$produits_a_vendre = produit($id_membre);
$initiale = get_initiale_user($id_membre);

$recherche = isset($_GET['recherche']) ? trim($_GET['recherche']) : '';
$categorie = isset($_GET['categorie']) ? trim($_GET['categorie']) : '';
$requete = mysqli_query($db, "SELECT * FROM categorie");
$produits = getProduitsFiltres($db, $recherche, $categorie);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Accueil - IT Mivarotra</title>
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
<li class="nav-item"><a class="nav-link active" href="accueil.php?id_membre=<?php echo $id_membre; ?>">Accueil</a></li>
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

<?php if (isset($_SESSION['mess'])) { ?>
<div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm" role="alert">
<?php echo $_SESSION['mess']; unset($_SESSION['mess']); ?>
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php } ?>

<!-- Formulaire de recherche -->
<div class="card border-0 shadow-sm mb-4">
<div class="card-body bg-white rounded p-4">
<form method="GET" action="accueil.php" class="row g-3 align-items-center">
<div class="col-md-5">
    <input type="text" name="recherche" class="form-control" placeholder="Nom du produit..." value="<?php echo htmlspecialchars($recherche); ?>">
</div>
<div class="col-md-4">
    <select name="categorie" class="form-select">
        <option value="">Toutes les catégories</option>
        <?php while ($categ = mysqli_fetch_assoc($requete)) { ?>
            <option value="<?php echo $categ['id_categorie']; ?>" <?php if ($categorie == $categ['id_categorie']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($categ['nom_categorie']); ?>
            </option>
        <?php } ?>
    </select>
</div>
<div class="col-md-3 d-flex gap-2">
    <button type="submit" class="btn btn-success flex-grow-1">Filtrer</button>
    <a href="accueil.php" class="btn btn-outline-secondary">Effacer</a>
</div>
</form>
</div>
</div>

<!-- Filtre produit -->
<h2 class="text-dark h4 mb-3 fw-bold">Résultats de la recherche</h2>
<div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
<?php if (mysqli_num_rows($produits) > 0) { ?>
<?php while ($p = mysqli_fetch_assoc($produits)) { ?>
<div class="col">
    <div class="card h-100 shadow-sm border-0 border-top border-4 border-success">
        <div class="card-body">
            <h5 class="card-title text-success fw-bold"><?php echo htmlspecialchars($p['nomProduit']); ?></h5>
            <p class="card-text mb-1"><strong>Vendeur :</strong> <?php echo htmlspecialchars($p['nomMembre']); ?></p>
            <p class="card-text mb-1"><strong>Stock :</strong> <span class="badge bg-secondary"><?php echo $p['quantite_dispo']; ?></span></p>
            <h6 class="text-dark fw-bold mt-2 fs-5"><?php echo $p['prix_reference']; ?> Ar</h6>
        </div>
    </div>
</div>
<?php } ?>
<?php } else { ?>
<div class="col-12"><div class="alert alert-warning border-0 shadow-sm">Aucun produit ne correspond à votre recherche.</div></div>
<?php } ?>
</div>

<hr class="my-5 text-secondary">

<!-- Produits Globaux à vendre -->
<h2 class="text-dark h4 mb-3 fw-bold">Tous les produits en vente</h2>
<div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
<?php foreach($produits_a_vendre as $p) { ?>
<?php 
$nom_photo = $p['photo_produit'];
$chemin_physique = '/opt/lampp/htdocs/Exam-S2/asset/images/' . $nom_photo;
$photo_a_afficher = (empty($nom_photo) || !file_exists($chemin_physique)) ? 'default.png' : $nom_photo;
?>
<div class="col">
<div class="card h-100 shadow-sm border-0">
    <img src="/Exam-S2/asset/images/<?php echo $photo_a_afficher; ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
    <div class="card-body">
        <h5 class="card-title fw-bold text-dark"><?php echo $p['nomProduit']; ?></h5>
        <p class="card-text mb-1 text-muted"><strong>Vendeur :</strong> <?php echo $p['nomMembre']; ?></p>
        <p class="card-text mb-1 text-muted"><strong>Quantité :</strong> <?php echo $p['quantite_dispo']; ?></p>
        <h5 class="text-success fw-bold mt-2"><?php echo $p['prix_reference']; ?> Ar</h5>
    </div>
    <div class="card-footer bg-white border-0 pb-3">
        <a href="achat.php?idProd=<?php echo $p['idProdMembre']; ?>&id_membre=<?php echo $id_membre; ?>" class="btn btn-success w-100">
            Acheter
        </a>
    </div>
</div>
</div>
<?php } ?>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>