Création du repo : Système de d'authentification PHP/TWIG

Contraintes techniques :

- composer
- symfony/var-dumper
- symfony/yaml
- twig/twig
- bootstrap : installation avec npm ou avec un cdn

Formulaire :

- identifiant : input type text, max 190 caractères inclus
- password : input type password, min 8 max 32 caractères inclus, caractères alphanumériques et spéciaux dont minimum 1 chiffre, 1 caractère spécial
- validation : respect de la structure du code html et des classes css pour la validation côté serveur
- message d'erreur : affichage d'un message d'erreur générique pour ne pas révéler si c'est l'identifiant ou le mot de passe qui est faux
- ré-affichage des données utilisateur après envoi des données (pour que l'utilisateur puisse corriger les données si besoin)

Livraison :

- envoyez-moi votre lien github
- il me faut au moins les fichiers suivants
  - /composer.json, composer.lock
  - /public/login.php
  - /templates/login.html.twig
- attention : ne pas commiter le dossier /vendor
