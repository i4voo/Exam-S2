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
- [ ] membre (id_membre, nom , numero_etu, image_profil)
- [ ] categorie ( id_categorie, nom_categorie)
- [ ] produit (id_produit, nom , id_categorie, prix_reference)
- [ ] produit_membre (id_produit_membre, id_produit, id_membre, prix_vente,
quantite_dispo, date_dispo)
- [ ] vente (id_vente, date , heure , id_produit_membre, quantite)
- [ ] 10 membres
- [ ]​ catégorie : plat , boisson, snack , dessert
-


