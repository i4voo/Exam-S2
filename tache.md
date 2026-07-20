# EXAMEN S2 

## Iavo partie (ETU005085)

### Création page
- [x] Login
○​ numéro ETU uniquement
○​ Si le numéro ETU n’est pas dans la base , on inscrit automatiquement le
membre et le demande de remplir le champ “nom”. L’image profil n’est pas
obligatoire

- [x] Accueil
○​ pour voir les produits à vendre par des membres , avec 1 bouton “acheter” et
1 champ “quantité” sur chaque produit.​
On achete directement les produits, pas de notion de panier. Mais il y a un
notion de quantité disponible.

- [x]  Vendre
○​ pour permettre de vendre des produits.

- [x] Mes ventes
○​ pour afficher le montant total des ventes effectués par un membre

## Tanjona partie (ETU005045)

### Création base de données
- [x] membre (id_membre, nom , numero_etu, image_profil)
- [x] categorie ( id_categorie, nom_categorie)
- [x] produit (id_produit, nom , id_categorie, prix_reference)
- [x] produit_membre (id_produit_membre, id_produit, id_membre, prix_vente,
quantite_dispo, date_dispo)
- [x] vente (id_vente, date , heure , id_produit_membre, quantite)
- [x] 10 membres
- [x]​ catégorie : plat , boisson, snack , dessert



# Version 2 


##  base.sql (Mise à jour Base de Données) — Tanjona

### Données
- [x] Ajouter la colonne `image_defaut` (VARCHAR) à la table `produit`
- [x] Ajouter la colonne `est_perime` (BOOLEAN / INT, défaut 0) à la table `produit`
- [x] Vérifier la présence du champ `image` dans `produit_membre` pour les photos personnalisées

### Codes
- [x] Exécuter les requêtes `ALTER TABLE` ou mettre à jour le script de création SQL

---

##  functions.php (Nouvelles fonctions V2) — Tanjona & Iavo

### Fonctions à ajouter / adapter
- [ ] **Iavo** : Adapter `vendre_produit()` pour gérer le téléversement de la photo custom ou utiliser la photo par défaut du produit
- [ ] **Iavo** : Adapter `getProduitsFiltres($db, $recherche, $categorie)` pour exclure les produits périmés (`est_perime = 0`)
- [x] **Tanjona** : Créer `ajouter_produit_ref($nom, $id_categorie, $prix_ref, $image_defaut)`
- [x] **Tanjona** : Créer `modifier_produit_ref($id_produit, $nom, $id_categorie, $prix_ref, $image_defaut, $est_perime)`
- [x] **Tanjona** : Créer `get_produit_by_id($id_produit)`
- [x] **Tanjona** : Créer `get_ventes_par_categorie()` (Somme des ventes par catégorie)
- [x] **Tanjona** : Créer `get_ventes_par_produit($id_categorie)` (Somme des ventes par produit)
- [x] **Tanjona** : Créer `get_ventes_par_membre($id_produit)` (Ventes par membre)

---

##  accueil.php (Filtres V2) — Iavo

### Affichage
- [ ] **HTML** : Ajouter le formulaire de filtre (champ texte pour le produit + `<select>` des catégories)
- [ ] **HTML** : Mettre en place le bouton de validation du filtre
- [ ] **HTML** : Afficher la photo custom du membre ou l'image par défaut (`IFNULL(pm.image, p.image)`)
- [ ] **CSS** : Styler la barre de recherche et les sélecteurs de filtre

### Données
- [ ] Récupérer les variables `$recherche` et `$id_categorie`

### Fonctions
- [ ] Appeler `getProduitsFiltres($db, $recherche, $categorie)`

### Codes
- [ ] Récupérer les filtres passés en `GET` ou `POST`
- [ ] Exécuter la requête filtrée et afficher dynamiquement les produits en stock non périmés

---

## vendre.php (Photo Plat V2) — Tanjona

### Affichage
- [x] **HTML** : Ajouter le champ d'upload de photo `<input type="file" name="image_custom">`
- [x] **HTML** : Ajouter l'indication "Optionnel : si vide, l'image par défaut sera utilisée"
- [x] **bootstrap** : styler le champ d'importation de fichier

### Données
- [x] Récupérer le fichier téléversé (`$_FILES['image_custom']`)

### Fonctions
- [x] Utiliser `vendre_produit(...)`

### Codes
- [x] Traiter l'upload avec `move_uploaded_file()`
- [x] Ajouter la condition : si aucune image n'est choisie, insérer `default.png` ou `NULL`

---

## gestion_produit.php (Ajout / Édition / Périmé) — Iavo

### Affichage
- [ ] **HTML** : Créer le formulaire d'ajout / modification de produit (`nom`, `id_categorie`, `prix_reference`, `image_defaut`)
- [ ] **HTML** : Ajouter la case à cocher `<input type="checkbox" name="est_perime"> Périmé`
- [ ] **HTML** : Créer le tableau des produits de référence existants avec bouton "Modifier"
- [ ] **CSS** : Appliquer un style visuel clair pour différencier les produits marqués comme "périmés"

### Données
- [ ] Manipuler la table `produit` (`id_produit`, `nom`, `id_categorie`, `prix_reference`, `image_defaut`, `est_perime`)

### Fonctions
- [ ] Appeler `ajouter_produit_ref()`
- [ ] Appeler `modifier_produit_ref()`
- [ ] Appeler `get_id_produit()`

### Codes
- [ ] Gérer l'état du formulaire (Mode "Ajout" vs Mode "Édition" selon la présence d'un ID en `GET`)
- [ ] Récupérer la valeur de la case à cocher `est_perime` en `POST` (1 si cochée, 0 sinon)
- [ ] Exécuter les requêtes `INSERT` ou `UPDATE` en BDD

---

## statistiques.php (Stats V2 par Catégorie, Produit & Membre) — Iavo

### Affichage
- [ ] **HTML** : **Niveau 1** — Afficher le tableau/liste des ventes par catégorie avec lien vers le détail
- [ ] **HTML** : **Niveau 2** — Afficher les ventes par produit pour la catégorie sélectionnée avec lien
- [ ] **HTML** : **Niveau 3** — Afficher les ventes par membre pour le produit sélectionné
- [ ] **HTML** : Ajouter des boutons "Retour" pour remonter d'un niveau
- [ ] **CSS** : Mettre en page les cartes ou tableaux statistiques de manière claire

### Données
- [ ] Exploiter les données de `vente`, `produit_membre`, `produit`, `categorie`, `membre`

### Fonctions
- [ ] Appeler `get_ventes_par_categorie()`
- [ ] Appeler `get_ventes_par_produit($id_categorie)`
- [ ] Appeler `get_ventes_par_membre($id_produit)`

### Codes
- [ ] Gérer la navigation hiérarchique avec les paramètres `GET` (`?id_categorie=...` ou `?id_produit=...`)
- [ ] Afficher la bonne vue (Niveau 1, 2 ou 3) selon les paramètres passés dans l'URL

