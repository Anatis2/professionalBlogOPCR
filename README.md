professionalBlogOPCR
=========================

Description de l'application
---------------------------------

Cette application a été effectuée dans le cadre d'une formation de développeur d'applications PHP/Symfony.

L'objectif était d'apprendre les bonnes pratiques de développement sans utiliser de CMS ni de framework.

Cette application possède plusieurs fonctionnalités, notamment liées à la gestion d'un blog profesionnel, et prend en compte la gestion des droits en fonction de 3 types d'acteurs : utilisateur, membre et administrateur.


Installation de l'application
---------------------------------

1. Télécharger le projet sur GitHub (https://github.com/Anatis2/professionalBlogOPCR), en faisant un git clone.
2. Copier le dossier "conf" présent dans le dossier "Livrables" et le coller la racine du projet. 
Y modifier les valeurs du fichier "config.php" si besoin
3. Dans phpMyAdmin :

    a. Créer la base de données "opcr_projet5_professionalBlog" ;

    b. Dans cette BDD nouvellement créée, importer le fichier "ExportBDDProfessionalBlog.sql" (que vous trouverez dans le dossier "initDb");
4. Informations de connexion pour les tests :
    - en tant que membre =>
		 email : member@member.fr ;
		 mot de passe : member
    - en tant qu'administrateur =>
		 email : admin@admin.fr ;
		 mot de passe : admin






