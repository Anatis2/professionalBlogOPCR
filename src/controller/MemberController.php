<?php

require_once 'src/DAO/MemberManager.php';

class MemberController extends \ClaireC\controller\Controller {

    /**
     * Verify default $_POST variables, with htmlspecialchars, trim and filter_input functions
     * @param $post
     * @return string
     */
    public function defaultPostControl($postName) {
        return htmlspecialchars(trim(filter_input(INPUT_POST, $postName)));
    }

    public function createMember() {
        $memberManager = new MemberManager();
        if((isset($_POST['surname']) && (isset($_POST['firstname']))) && (isset($_POST['email'])) && (isset($_POST['pseudo']))
            && (isset($_POST['password'])) && (isset($_POST['passwordConf']))) {
            $surname = $this->defaultPostControl('surname');
            $firstname = $this->defaultPostControl('firstname');
            $email = $this->defaultPostControl('email');
            $emailToVerify = $memberManager->verifyEmailMember($email)[0];
            $pseudo = $this->defaultPostControl('pseudo');
            if($email == $emailToVerify) {
                echo $this->twig->render('inscription.twig',
                    ['messageCreateMember' => "<p class='alert alert-danger'>Cet email est déjà utilisé...</p>",
                        'surname' => $surname,
                        'firstname' => $firstname,
                        'email' => $email,
                        'pseudo' => $pseudo
                    ]);
                exit;
            }
            $pseudoToVerify = $memberManager->verifyPseudoMember($pseudo)[0];
            if($pseudo == $pseudoToVerify) {
                echo $this->twig->render('inscription.twig',
                    ['messageCreateMember' => "<p class='alert alert-danger'>Ce pseudo est déjà utilisé... Veuillez choisir un autre pseudo.</p>",
                        'surname' => $surname,
                        'firstname' => $firstname,
                        'email' => $email,
                        'pseudo' => $pseudo
                    ]);
                exit;
            }
            $password = htmlspecialchars(trim($_POST['password']));
            $passwordConf = htmlspecialchars(trim($_POST['passwordConf']));
            $passwordHash = htmlspecialchars(trim(password_hash($_POST['password'], PASSWORD_DEFAULT)));
            if (($password) == ($passwordConf)) {
                $memberManager->createMember($surname, $firstname, $pseudo, $email, $passwordHash);
                echo $this->twig->render('home.twig',
                    [ 'messageCreateMember' => "<p class='alert alert-success'>Votre inscription a bien été prise en compte !</p>"
                    ]);
            } else {
                echo $this->twig->render('inscription.twig',
                    ['messageCreateMember' => "<p class='alert alert-danger'>Les deux mots de passe ne correspondent pas !!! Veuillez réessayer...</p>",
                        'surname' => $surname,
                        'firstname' => $firstname,
                        'email' => $email,
                        'pseudo' => $pseudo
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
                $idPerson = $connectedMember[0]['idPerson'];
                $surnamePerson = $connectedMember[0]['surnamePerson'];
                $firstnamePerson = $connectedMember[0]['firstnamePerson'];
                $pseudoPerson = $connectedMember[0]['pseudoPerson'];
                $emailPerson = $connectedMember[0]['emailPerson'];
                $dateRegistrationPerson = $connectedMember[0]['dateRegistrationPerson'];
                $typePerson = $connectedMember[0]['typePerson'];
                $passwordPerson = $connectedMember[0]['passwordPerson'];
                $passwordIsCorrect = password_verify($password, $passwordPerson);
                if ($passwordIsCorrect) {
                    $_SESSION['idPerson'] = $idPerson;
                    $_SESSION['surnamePerson'] = $surnamePerson;
                    $_SESSION['firstnamePerson'] = $firstnamePerson;
                    $_SESSION['pseudoPerson'] = $pseudoPerson;
                    $_SESSION['emailPerson'] = $emailPerson;
                    $_SESSION['dateRegistrationPerson'] = $dateRegistrationPerson;
                    $_SESSION['typePerson'] = $typePerson;
                    $isConnected = parent::verifyConnection();
                    $isAdmin = parent::isAdmin();
                    if($isAdmin){
                        header('Location: index.php?page=adminHome');
                    } else {
                        echo $this->twig->render('home.twig',
                            [ 'isConnected' => $isConnected,
                                'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                                'isAdmin' => $isAdmin
                            ]);
                    }
                } else {
                    echo $this->twig->render('connection.twig',
                        [ 'messageConnection' => "<p class='alert alert-danger'>L'identifiant et/ou le mot de passe ne sont pas valides.</p>"
                        ]);
                }
            } else {
                echo $this->twig->render('connection.twig',
                    [ 'messageConnection' => "<p class='alert alert-danger'>L'identifiant et/ou le mot de passe ne sont pas valides.</p>"
                    ]);
            }
        } else {
             echo $this->twig->render('connection.twig');
         }
    }

    public function getPageAdminHome() {
        $isConnected = parent::verifyConnection();
        $isAdmin = parent::isAdmin();
        if($isAdmin) {
            $pseudoPerson = $_SESSION['pseudoPerson'];
            echo $this->twig->render('adminHome.twig',
                [   'isConnected' => $isConnected,
                    'isAdmin' => $isAdmin,
                    'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>"
                ]);
        } else {
            echo $this->twig->render('403.twig');
        }
    }


    public function getMemberProfile() {
        $isConnected = self::verifyConnection();
        $isAdmin = parent::isAdmin();
        if($isConnected) {
            echo $this->twig->render('adminSeeMyProfile.twig',
                [   'isConnected' => $isConnected,
                    'isAdmin' => $isAdmin,
                    'messageConnection' => "<p>Vous êtes connecté en tant que $_SESSION[pseudoPerson]</p>",
                    'surnamePerson' => $_SESSION['surnamePerson'],
                    'firstnamePerson' => $_SESSION['firstnamePerson'],
                    'pseudoPerson' => $_SESSION['pseudoPerson'],
                    'emailPerson' => $_SESSION['emailPerson'],
                    'dateRegistrationPerson' => $_SESSION['dateRegistrationPerson'],
                    'typePerson' => $_SESSION['typePerson']
                ]);
        }
    }

    public function listMembers() {
        $isConnected = self::verifyConnection();
        $isAdmin = parent::isAdmin();
        if($isConnected) {
            $memberManager = new MemberManager();
            echo $this->twig->render('adminListMembers.twig',
                [   'isConnected' => $isConnected,
                    'isAdmin' => $isAdmin,
                    'messageConnection' => "<p>Vous êtes connecté en tant que $_SESSION[pseudoPerson]</p>",
                    'listMembers' => $memberManager->listMembers()
                ]);
        }
    }


}