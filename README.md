# ME.trip

## Installation

Uniquement besoin de lancer un serveur php à la racine du projet et avoir un serveur mysql fonctionnel. Le php lancera le script d'initialisation de la base de donnée automatiquement

ETA 20/10/2019: Pour l'instant, la base de donnée est regénérée à chaque chargement de la page index, ce comportement disparaitra une fois le panneau d'administration développé

Comptes:
`email:pass`
+ admin: `root@root.com:root`
+ utilisateur: `foo@bar.com:foo`
## sprints
### 1:
+ En tant qu’utilisateur, je veux voir les voyages disponibles afin de choisir un voyage

### 2:
+ En tant qu’utilisateur, je veux créer un compte avec un mdp sécurisé afin de me connecter
+ En tant qu'utilisateur, je veux me connecter et rester connecté au site
+ En tant qu’administrateur connecté ou agence de voyage connecté, je veux créer un voyage

### 3:
+ En tant qu’administrateur connecté ou agence de voyage connecté, je veux changer les caractéristiques d’un voyage
+ En tant qu’utilisateur connecté, je veux réserver des voyages
+ En tant qu’utilisateur connecté, je veux voir les voyages que j’ai réserver

### 4:
+ En tant qu’utilisateur connecté, je veux créer et enlever des voyages en tant que favoris
+ En tant qu’utilisateur connecté, je veux voir mes voyages favoris dans une seule page

## Explications

Le site est entièrement rédigé en anglais, que ce soit pour le code ou pour l'html pour avoir une plus grande accessibilité.

Les sources de mon projet sont accessible sur mon github: https://github.com/torsina/S3_php_projet

J'ai choisi d'essayer de faire mon propre MVC pour m'instruire et ne pas avoir à tout re-ecrire dans le sprint 4

Beaucoup de temps a été dédié au backend sur le sprint 1, d'où la seule user story présente

.htaccess est utilisé pour rediriger toutes les requètes vers le routeur `index.php`

Le mot de passe utilisateur est salted avec la formule suivante: 
```php
// dans utils/datatypes/User.php

$salt = hash("sha512", $this->id);
$this->password = hash("sha512", $password . $salt);
```
où `$this->id` est un UUIDv4
## Sources externes

https://pixabay.com/
https://www.flaticon.com/authors/smashicons