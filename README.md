Thème wordpress pour le site du groupe de rockabilly **Riding Cats**.

Ce projet contient les sources du thème (répertoire *ridingcats*) ainsi que la configuration *Docker* permettant de faciliter les déveoppements et les tests.


# Développement
## Prerequis
Docker version 18.09.0, build 4d60db4

## Commmencer à développer
```sh
docker-compose up -d
```

Puis ouvrir le navigateur sur http://localhost:8080

Deux volumes sont montés :
- le répertoire *ridingcats* du projet dans le répertoire *theme* du *wordpress* ;
- le répertoire *wp-content* du *wordpress* dans le répertoire du projet pour pouvoir s'inspirer des thèmes existants.

# Guide d'utilisation

## Installation
- Installer un wordpress ;
- Installer le plugin **Final Tiles Grid Gallery**.

## Utilisation
Le principe du thème est d'afficher tous les posts d'une catégorie sur une seule page (il n'y a pas d'affichage d'un seul post à la fois.).

Ces posts doivent être simple (un texte, une image à mettre en avant, une date...).

Le thème Riding Cats fournit un certains nombre de categories par défault :

- Biographie;
- Actus;
- Presse;
- Contact;
- Vidéos;
- Photos.

Ces catégories sont à affecter aux différents posts afin de les placer dans le bon menu.

Selon la catégorie, le post sera représenté de façon différente.

## Créer une entrée Biographie

Une biographie est constituée d'un texte et d'une image de 300px de large.

1. Créer un nouvel article ;
1. Le titre n'a pas d'importance ;
1. Le corps du post contient un texte éventuellement mis en forme ;
1. L'image à associer est mise dans le champ *Image à la une* ;
1. La date est choisie pour afficher cette entrée au bon endroit (les posts sont affichés de la date la plus récente à la plus ancienne) ;
1. On affecte la catégorie *Biographie* et on retire toutes les autres ;
1. Publier l'article.

## Créer une entrée Actu
//TODO

## Créer une entrée Presse
//TODO

## Créer une entrée Contact
//TODO

## Créer une entrée Vidéo
//TODO

## Créer une entrée Photo
//TODO

## Construction du menu

Le menu (*Header menu*) est constitué ainsi :
- *Riding Cats* : lien personnalisé amenant à la page d'accueil ;
- *Biographie* : menu affichant la catégorie *Biographie*
- *Actus* : //TODO
- *Presse* : //TODO
- *Contact* : //TODO
- *Vidéos* : //TODO
- *Photos* :
  1. Créer une gallerie avec **Final Tiles Grid Gallery**,
  1. Copier le *shortcode*,
  1. Créer une page nommée *Gallerie Photo*,
  1. Y coller le shortcode,
  1. Editer le menu et ajouter la page *Gallerie Photo* avec comme nom de menu *PHOTOS*.
