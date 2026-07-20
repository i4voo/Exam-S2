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
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Inscription</title>
</head>
<body class="bg-light d-flex align-items-center vh-100">

<div class="container">
<div class="row justify-content-center">
<div class="col-md-5">
<div class="card shadow-lg border-0 border-top border-5 border-success">
<div class="card-body p-4">
<div class="alert alert-warning text-center" role="alert">
<strong>Numéro ETU inconnu !</strong> Veuillez vous inscrire pour continuer.
</div>

<form action="traitement_login.php" method="post">
<input type="hidden" name="etu" value="<?php echo htmlspecialchars($etu_inconnu ?? '', ENT_QUOTES, 'UTF-8'); ?>">

<div class="mb-3">
    <label for="nom" class="form-label fw-bold">Votre Nom complet :</label>
    <input type="text" name="nom" id="nom" class="form-control" required placeholder="Ex: Jean Dupont">
</div>

<button type="submit" class="btn btn-success w-100 py-2">S'inscrire et continuer</button>
</form>
    </div>
    </div>
    </div>
</div>
</div>

</body>
</html>