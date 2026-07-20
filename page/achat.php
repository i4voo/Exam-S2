<?php
include('../inc/function.php');
if (isset($_GET['id_membre'])) {
    $id_membre = $_GET['id_membre'];
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


?>