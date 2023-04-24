<?php

namespace Core;
use PDO;
class Model
{
    public $dbh;
	public function __construct()
	{  
		$this->dbh = new PDO('mysql:host=localhost;dbname=page', 'root', '');
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}
