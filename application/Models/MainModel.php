<?php

namespace Models;
use Core\Model;
use PDO;
class AuthorizationModel extends Model
{ 
    function getUser($email, $password) {

            $sth = $this->dbh->prepare(
                "SELECT * FROM Users WHERE email = :email"
            );

            $sth->bindParam(':email', $email);
            $sth->execute();
            $user = $sth->fetch(PDO::FETCH_ASSOC);
            return $user;
    }
}
  