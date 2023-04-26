<?php

namespace Models;

use Core\Model;


class RegistrationModel extends Model
{
    function setUser($email, $username, $password)
    {

        try {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sth = $this->dbh->prepare(
                "INSERT INTO Users (email, username, password) 
                    VALUES (:email, :username, :password)"
            );

            $sth->bindParam(':email', $email);
            $sth->bindParam(':username', $username);
            $sth->bindParam(':password', $password_hash);
            $sth->execute();
            return true;

        } catch (Exception $e) {
            return false;
        }
    }
}