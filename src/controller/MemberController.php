<?php

require_once('src/DAO/MemberManager.php');

class MemberController {

    public function __construct() {
        // Initilisation to use Twig
        $loader = new Twig_Loader_Filesystem('templates');
        $this->twig = new Twig_Environment($loader, [
            'cache' => false, // __DIR__ . '/tmp'
        ]);
    }

    public function createMember() {
        $memberManager = new MemberManager();
         if((isset($_POST['surname']) && (isset($_POST['firstname']))) && (isset($_POST['email'])) && (isset($_POST['pseudo']))
            && (isset($_POST['password'])) && (isset($_POST['passwordConf']))) {
            $surname = htmlspecialchars(trim($_POST['surname']));
            $firstname = htmlspecialchars(trim($_POST['firstname']));
            $email = htmlspecialchars(trim($_POST['email']));
            $pseudo = htmlspecialchars(trim($_POST['pseudo']));
            $password = htmlspecialchars(trim($_POST['password']));
            $passwordConf = htmlspecialchars(trim($_POST['passwordConf']));
            $passwordHash = htmlspecialchars(trim(password_hash($_POST['password'], PASSWORD_DEFAULT)));
            if (($password) == ($passwordConf)) {
                echo $this->twig->render('home.twig',
                    ['affectedLinesCreateMember' => $memberManager->createMember($surname, $firstname, $pseudo, $email, $passwordHash),
                        'messageCreateMember' => "<p class='alert alert-success'>Votre inscription a bien été prise en compte !</p>"
                    ]);
            } else {
                echo $this->twig->render('inscription.twig',
                    ['messageCreateMember' => "<p class='alert alert-danger'>Les deux mots de passe ne correspondent pas !!! Veuillez réessayer...</p>"
                    ]);
            }
        } else {
            echo $this->twig->render('inscription.twig');
        }
    }

    public function connectMember() {
        $memberManager = new MemberManager();
         if ((isset($_POST['email'])) && (isset($_POST['password']))) {
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));
            $connectedMember = $memberManager->connectMember($email);
            if(!empty($connectedMember)) {
                $pseudoPerson = $connectedMember[0]['pseudoPerson'];
                $passwordPerson = $connectedMember[0]['passwordPerson'];
                $passwordIsCorrect = password_verify($password, $passwordPerson);
                if ($passwordIsCorrect) {
                    $_SESSION['pseudoPerson'] = $pseudoPerson;
                    header('Location: index.php?page=home');
                } else {
                    $messageConnection = "<p class='alert alert-danger'>L'identifiant et/ou le mot de passe ne sont pas valides.</p>";
                    return $messageConnection;
                }
            } else {
                $messageConnection = "<p class='alert alert-danger'>L'identifiant et/ou le mot de passe ne sont pas valides.</p>";
                return $messageConnection;
            }
        }
    }

}