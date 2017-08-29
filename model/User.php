<?php
require_once('BaseModel.php');

class User extends BaseModel{
    
    
    public static function getUserByUsernamePassword($username, $password){
        $sql = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";
        $password = md5($password);
        $result = self::execute($sql, [$username, $password]);
		return  $result->fetch(PDO::FETCH_ASSOC);
    }
}