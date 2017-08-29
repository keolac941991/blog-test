<?php
class BaseModel{

    static protected $_pdo;

    public static function connect(){
        if(!is_resource(self::$_pdo)){
            try {
                $dsn = 'mysql:host=' . HOSTNAME . ';dbname=' . DATABASE;
                self::$_pdo = new PDO($dsn, USERNAME, PASSWORD);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
    }
    
    public static function close(){
        self::$_pdo = null;
    }
    
    public static function execute($sql, $params){
        self::connect();
        $pdoStatement = self::$_pdo->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }
}