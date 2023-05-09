<?php


$pregPass = [
    'digits' => '@[0-9]@',
    'capital letters' => '#[A-Z]+#',
    'lowercase letters' => '#[a-z]+#'
];
$password = 'qwegtfhjkl';
$confirmation_password = 'qwegtf222';


if ($password != $confirmation_password) {
    var_dump('error confirmation');
}


foreach ($pregPass as $key => $value) {
    if (!preg_match($value, $password)) {
      
        var_dump('error preg pass');
        die();
    }
}