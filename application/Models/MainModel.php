<?php

namespace Models;

use Core\Model;
use Exception;


class MainModel extends Model
{
    public function setComment($username, $text_comment)
    {
        $response = [];

        try {
    
            $name = htmlspecialchars($username);
            $sth = $this->dbh->prepare(
                "INSERT INTO Comment(text_comment, name) 
                    VALUES (:text_comment, :name)"
            );

            $sth->bindParam(':text_comment', $text_comment);
            $sth->bindParam(':name', $name);
            $sth->execute();
            $response['status'] = 'success';
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public function GetComment()
    {
        if( $response['status'] = 'success'){
        $sth=$this->dbh->prepare (
            "SELECT * FROM Users"
        );
        return $sth;
        }
    }
}
