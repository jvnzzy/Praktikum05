<?php
function login($email,$password){
    $link = createMySQLConnection();
    $querry = 'SELECT id,name,email FROM user WHERE email = ? AND password= MD5(?)';
    $stmt = $link->prepare($querry);
    $stmt->bindParam(1,$email);
    $stmt->bindParam(2,$password);
    $stmt->execute();
    $user = $stmt->fetch();
    $link = null;
    return $user;
}