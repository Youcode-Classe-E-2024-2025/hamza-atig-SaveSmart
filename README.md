# Youdemy - Plateforme de Cours en Ligne

## Contexte du Projet
Youdemy est une plateforme de cours en ligne qui vise à offrir une expérience d'apprentissage interactive et personnalisée pour les étudiants et les enseignants.

## Diagrame

## Fonctionnalités Requises

### Partie Front Office

#### Visiteur
- Accès au catalogue des cours avec pagination.
- Recherche de cours par mots-clés.
- Création d'un compte avec le choix du rôle (Etudiant ou Enseignant).

#### Etudiant
- Visualisation du catalogue des cours.
- Recherche et consultation des détails des cours (description, contenu, enseignant, etc.).
- Inscription à un cours après authentification.
- Accès à une section "Mes cours" regroupant les cours rejoints.

#### Enseignant
- Ajout de nouveaux cours avec :
  - Titre, description, contenu (vidéo ou document), tags et catégorie.
- Gestion des cours :
  - Modification, suppression et consultation des inscriptions.
- Accès à une section "Statistiques" sur les cours :
  - Nombre d'étudiants inscrits, Nombre de cours, etc.

### Partie Back Office

#### Administrateur
- Validation des comptes enseignants.
- Gestion des utilisateurs : Activation, suspension ou suppression.
- Gestion des contenus : Cours, catégories et tags.
- Insertion en masse de tags pour gagner en efficacité.
- Accès à des statistiques globales :
  - Nombre total de cours, répartition par catégorie, le cours avec le plus d'étudiants, Top 3 enseignants.

### Fonctionnalités Transversales
- Un cours peut contenir plusieurs tags (relation many-to-many).
- Application du concept de polymorphisme dans les méthodes "Ajouter cours" et "Afficher cours".
- Système d’authentification et d’autorisation pour protéger les routes sensibles.
- Contrôle d’accès selon le rôle de l’utilisateur.

## Exigences Techniques
- Respect des principes OOP (encapsulation, héritage, polymorphisme).
- Base de données relationnelle avec gestion des relations (one-to-many, many-to-many).
- Utilisation des sessions PHP pour la gestion des utilisateurs connectés.
- Système de validation des données utilisateur pour garantir la sécurité.

## Bonus
- Recherche avancée avec filtres (catégorie, tags, auteur).
- Statistiques avancées : taux d’engagement par cours, catégories populaires.
- Système de notifications (ex. validation de compte enseignant, confirmation d'inscription).
- Implémentation d’un système de commentaires ou d’évaluations sur les cours.
- Génération de certificats PDF de complétion pour les étudiants.

## Modalités Pédagogiques
- **Travail individuel**
- **Durée :** 5 jours
- **Date de lancement :** 13/01/2025 à 09:00 AM
- **Date limite de soumission :** 20/01/2025 avant 05:30 PM

## Modalités d'évaluation
Durée de 35 minutes :
1. **Présentation publique** du projet devant les jurys (~10 minutes).
2. **Code Review & Questions techniques** (10 minutes).
3. **Mise en situation** (15 minutes).

## Livrables
- Lien du repository GitHub du projet.
- Lien de la présentation.
- Diagrammes UML :
  - Diagramme des cas d'utilisation.
  - Diagramme de classes.

## Critères de Performance
- Séparation claire entre logique métier et architecture.
- Cohérence dans l'application des concepts OOP.
- Amélioration de la structure et de la lisibilité du code.
- Utilisation appropriée des classes, objets et méthodes.
- Design responsive pour une adaptation à tous types d'écrans.
- Validation côté client (HTML5, JavaScript) et côté serveur.
- Protection contre les attaques XSS, CSRF et SQL injection (requêtes préparées, validation des entrées).

---

### Auteur(s) :
Projet réalisé par [Votre Nom / Équipe]

### Licence
Ce projet est sous licence [Licence de votre choix].

