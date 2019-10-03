<?php

namespace ClaireC\src\model;

class Member {

    protected $idMember;
    protected $surnameMember;
    protected $firstnameMember;
    protected $pseudoMember;
    protected $emailMember;
    protected $passwordMember;
    protected $dateRegistrationMember;
    protected $typeMember;

    public function __construct($donnees) {
        $this->hydrate($donnees);
    }

    public function hydrate($donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // GETTERS
    public function getIdMember() { return $this->idMember; }
    public function getSurnameMember() { return $this->surnameMember; }
    public function getFirstnameMember() { return $this->firstnameMember; }
    public function getPseudoMember() { return $this->pseudoMember; }
    public function getEmailMember() { return $this->emailMember; }
    public function getPasswordMember() { return $this->passwordMember; }
    public function getDateRegistrationMember() { return $this->dateRegistrationMember; }
    public function getTypeMember() { return $this->typeMember; }


    // SETTERS
    public function setIdMember($idMember) {
        $this->idMember = $idMember;
    }

    public function setSurnameMember($surnameMember) {
        $this->surnameMember = $surnameMember;
    }

    public function setFirstnameMember($firstnameMember) {
        $this->firstnameMember = $firstnameMember;
    }

    public function setPseudoMember($pseudoMember) {
        $this->pseudoMember = $pseudoMember;
    }

    public function setEmailMember($emailMember) {
        $this->emailMember = $emailMember;
    }

    public function setPasswordMember($passwordMember) {
        $this->passwordMember = $passwordMember;
    }

    public function setDateRegistrationMember($dateRegistrationMember) {
        $this->dateRegistrationMember = $dateRegistrationMember;
    }

    public function setTypeMember($typeMember){
        $this->typeMember = $typeMember;
    }






}