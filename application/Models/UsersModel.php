<?php

namespace Models;
use Core\Model;
use PDO;
class UsersModel extends Model
{ 
    public function getUser($email, $password) {

            $sth = $this->dbh->prepare(
                "SELECT * FROM Users WHERE email = :email"
            );

            $sth->bindParam(':email', $email);
            $sth->execute();
            $user = $sth->fetch(PDO::FETCH_ASSOC);
            return $user;
    }
    public function setUser($email, $username, $password)
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

        } catch (\Exception $e) {
            return false;
        }
    }
}
  