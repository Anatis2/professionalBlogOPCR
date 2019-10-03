<?php

use ClaireC\src\DAO\Manager;

class MemberManager extends Manager {

    public function createMember($surname, $firstname, $passwordHash) {
        $sql = 'INSERT INTO person(surnamePerson, firstnamePerson, passwordPerson)
                VALUES (?, ?, ?)';

        return $this->createQuery($sql, array($surname, $firstname, $passwordHash));

    }

}