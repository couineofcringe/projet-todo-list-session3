# Projet Gestion de Tâches - PWB - Session 3

Objectif : 
Création d'une application web de gestion de tâches impliquant : 

* Développement en full PHP natif.

* Gestion d'une BDD MySQL. 

* Suppression douce (corbeille).  

* Création d'une API JSON (export des données).


## Fonctionnalités :
* CRUD (Create, Read, Update, Delete) complet.
* Soft Delete (Corbeille avec restauration).
* Tri de tâches : catégorisation des tâches au moment de leur création.
* Nettoyage automatique des tâches supprimées (30 jours).
* API JSON filtrée (`/api.php`).
* UX/UI : Design responsive, Glassmorphisme, CSS Grid.


## Pourquoi avoir joint la BDD ?

BDD : **`gestion_taches_perso.sql`**

J'ai modifié la table `taches` pour inclure une nouvelle colonne, nommée `date_deleted`. 

J'ai ajouté cette colonne afin de supprimer des tâches. J'ai voulu suivre le même système que la suppression des mails. Ils sont rangés dans la corbeille et supprimés définitivement au bout d'un délai. 
Avoir ajouté cette fonction de nettoyage automatique permet de récupérer la tâche si elle n'est pas finie et de ne pas prendre de la place dans les colonnes du tableau de bord. 

Puisque la structure de la table a été modifiée, je l'ai intégrée afin d'éviter **Fatal Error: Unknown column 'date_deleted'**.


## Mise en place du projet localement :

Pour que le projet fonctionne correctement, il est conseillé de suivre ces étapes :

### 1. Base de Données :
Le fichier **`gestion_taches_perso.sql`** fourni à la racine contient la structure actualisée de la BDD.

* **Action :** Importer ce fichier dans phpMyAdmin.

### 2. Configuration de la connexion (Sécurité) :
Le fichier de connexion contenant les mots de passe (`connexion.php`) n'est pas inclus dans ce dépôt par mesure de sécurité (bonnes pratiques +1).

* **Action :** 
    1. Récupérer le fichier `connexion.example.php`.
    2. Le renommer en `connexion.php`.
    3. Entrer ses identifiants locaux (ex: root / root).


## Pistes d'amélioration :

### 1. Intégration d'un feedback user (Success):

* But : Améliorer l'UX avec une gratification

J'avais envie d'ajouter une réponse du programme lorsque l'on range une tâche dans la colonne "Terminé". J'avais pensé à une animation qui afficherait un petit texte, ainsi qu'une image ou une animation.
Je me demandais donc s'il valait mieux créer un petit popup à part avec un nouveau fichier et un fichier .js correspondant où intégrer cela dans un des fichiers php.

### 2. Filtrage dynamique par catégorie de tâches : 

* But : Afficher uniquement "tâches en cours", "Personnel", etc.

Pour l'instant, chaque tâche a un badge avec la catégorie. Pour trier de manière à rassembler les tâches selon leur catégorie, je me demandais s'il fallait :

1) Modifier la BDD de manière à créer des "sous-tables" ?
2) Modifier le code dans traitement.php ?
3) Apporter des modifications dans la BDD et dans les fichers.