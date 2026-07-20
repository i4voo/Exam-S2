<?php
include('../inc/function.php') ;
if (isset($_POST['etu'], $_POST['nom'])) {
    $id = inscription($_POST['etu'], $_POST['nom']);
    header('Location: accueil.php?id_membre=' . $id);
    exit();
}
if (isset($_POST['etu'])) {
    $membre = checklogin($_POST['etu']);
    if ($membre) {
        header('Location: accueil.php?id_membre=' . $membre['id_membre']);
        exit();
    }
    $etu_inconnu = $_POST['etu'];
} else {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    
    <h2>Numéro ETU inconnu ! Veuillez saisir votre nom pour vous inscrire :</h2>

    <form action="traitement_login.php" method="post">
       <input type="hidden" name="etu" value="<?php echo $etu_inconnu; ?>">
        
        <p>Votre Nom : <input type="text" name="nom" required placeholder="Ex: Jean Dupont"></p>
        <input type="submit" value="S'inscrire et continuer">
    </form>
</body>
</html>