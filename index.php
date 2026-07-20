<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Connexion</title>
</head>
<body class="bg-light d-flex align-items-center vh-100">

<div class="container">
<div class="row justify-content-center">
<div class="col-md-4">
<div class="card shadow-lg border-0 border-top border-5 border-dark">
<div class="card-body p-4">
<h2 class="text-center text-dark fw-bold mb-4">Connexion</h2>
<form action="page/traitement_login.php" method="post">
    <div class="mb-3">
        <label for="etu" class="form-label fw-bold">Numéro ETU</label>
        <input type="text" name="etu" id="etu" class="form-control" value="5045" placeholder="Saisir votre numéro ETU" required>
    </div>
    <button type="submit" class="btn btn-success w-100 py-2">Se connecter</button>
</form>
</div>
</div>
</div>
</div>
</div>

</body>
</html>