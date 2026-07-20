<?php
session_start();
include('../inc/function.php');

$id_membre = isset($_GET['id_membre']) ? $_GET['id_membre'] : (isset($_SESSION['id_membre']) ? $_SESSION['id_membre'] : null);

if (isset($_GET['idProd']) && !empty($_GET['idProd'])) {
    $id = $_GET['idProd'];
    
    $verif_quant = verif_quantite_produit($id);
    
    if ($verif_quant == "indispo") {
        $_SESSION['mess'] = "Le produit n'est plus disponible.";
    } 
    else if ($verif_quant == "dispo") {
        achat($id);
    }

    header('Location: accueil.php?id_membre=' . $id_membre);
    exit();
}

$initiale = get_initiale_user($id_membre); 
?>

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