<?php

namespace Models;

use Core\Model;


class RegistrationModel extends Model
{
    function setUser($email, $username, $password)
    {

        $this->dbh = new PDO('mysql:host=localhost;dbname=page', 'root', '');
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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