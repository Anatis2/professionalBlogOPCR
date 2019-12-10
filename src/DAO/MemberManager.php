<?php

use ClaireC\src\DAO\Manager;

class MemberManager extends Manager {

    /**
     * @param $surname
     * @param $firstname
     * @param $pseudo
     * @param $email
     * @param $passwordHash
     * @return bool|false|PDOStatement
     */
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

    /**
     * @param $email
     * @return array
     */
    public function connectMember($email) {
        $sql = 'SELECT *
                FROM person
                WHERE emailPerson = :emailPerson';
        return $this->createQuery($sql, array('emailPerson' => $email))->fetchAll();
    }

    /**
     * @return array
     */
    public function listMembers() {
        $sql = 'SELECT *
                FROM person';
        return $this->createQuery($sql)->fetchAll();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function verifyEmailMember($email) {
        $sql = 'SELECT emailPerson
                FROM person
                WHERE emailPerson = :emailPerson';
        return $this->createQuery($sql, array('emailPerson' => $email))->fetch();
    }

    /**
     * @param $pseudo
     * @return mixed
     */
    public function verifyPseudoMember($pseudo) {
        $sql = 'SELECT pseudoPerson
                FROM person
                WHERE pseudoPerson = :pseudoPerson';
        return $this->createQuery($sql, array('pseudoPerson' => $pseudo))->fetch();
    }

}