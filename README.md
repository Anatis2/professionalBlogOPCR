# professionalBlogOPCR


Installation de l'application :
================================


1. Télécharger le projet sur GitHub (https://github.com/Anatis2/professionalBlogOPCR), en faisant un git clone.

2. Dans phpMyAdmin :

    a. Créer la base de données "opcr_projet5_professionalBlog" ;
    
    b. Dans cette BDD nouvellement créée, importer le fichier "scriptCreationTableProfessionalBlog.sql" (que vous trouverez dans le dossier "initDb");
    
    c. Importer le fichier "scriptDatasProfessionalBlog.sql".
    
3. Ouvrir l'application, puis cliquer sur le bouton "s'inscrire" pour :

    a. Créer un membre :
    
        -> Nom : Member ;
        
        -> Prénom : Member ;
        
        -> Email : member@member.fr ;
        
        -> Pseudo : Member ;
        
        -> Mot de passe : member.
        
    b. Créer un administrateur :
    
        -> Nom : Admin ;
        
        -> Prénom : Admin ;
        
        -> Email : amdin@admin.fr ;
        
        -> Pseudo : Admin ;
        
        -> Mot de passe : admin.

4. Dans phpMyAdmin :

    a. Aller dans la table "person" ;
    
    b. Choisir la ligne contenant "Admin" et remplacer son type "typePerson" => Admin
    



