<?php

use ClaireC\src\DAO\Manager;

class MemberManager extends Manager {

    public function createMember($surname, $firstname, $pseudo, $email, $passwordHash) {
        $sql = 'INSERT INTO person(surnamePerson, firstnamePerson, pseudoPerson, emailPerson, passwordPerson)
                VALUES (?, ?, ?, ?, ?)';
        return $this->createQuery($sql, array($surname,
                                              $firstname,
                                              $pseudo,
                                              $email,
                                              $passwordHash
                                  ));
    }

    public function connectMember($email) {
        $sql = 'SELECT *
                FROM person
                WHERE emailPerson = :emailPerson';
        return $this->createQuery($sql, array('emailPerson' => $email))->fetchAll();
    }

    public function listMembers() {
        $sql = 'SELECT *
                FROM person';
        return $this->createQuery($sql)->fetchAll();
    }

}