<?php
session_start();
include('../inc/function.php');

if (isset($_POST['etu'])) {
    $etu = $_POST['etu'];
    $user = checklogin($etu);

    if ($user) {
        header('Location: accueil.php?id_membre=' . $user['id_membre']);
        exit();
    } else {
        header('Location: ../index.php');
        exit();
    }
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