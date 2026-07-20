<?php
session_start();
include('../inc/function.php') ;

if (isset($_POST['etu'], $_POST['nom'])) {
    $id = inscription($_POST['etu'], $_POST['nom']);
    $_SESSION['id_membre'] = $id;
    header('Location: accueil.php');
    exit();
}

if (isset($_POST['etu'])) {
    $membre = checklogin($_POST['etu']);
    if ($membre) {
        $_SESSION['id_membre'] = $membre['id_membre'];
        header('Location: accueil.php');
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
       <input type="hidden" name="etu" value="<?php echo htmlspecialchars($etu_inconnu, ENT_QUOTES, 'UTF-8'); ?>">
        
        <p>Votre Nom : <input type="text" name="nom" required placeholder="Ex: Jean Dupont"></p>
        <input type="submit" value="S'inscrire et continuer">
    </form>
</body>
</html>