<?php
require_once('BaseModel.php');

class Post extends BaseModel{
    
    private $title;
    private $body;
    private $date_created;
    private $date_modified;
    
    public function setTitle($title){
        $this->title = $title;
    }
    
    public function setBody($body){
        $this->body = $body;
    }
    
    public function getPostById($id){
        $sql = "SELECT * FROM posts WHERE id =?";
        $result = self::execute($sql, [$id]);
        $result = $result->fetch(PDO::FETCH_ASSOC);
		return $result; 
    }
    
     public static function updateStatus($id){
        $sql = "UPDATE  posts SET  status =1 WHERE id =?";
		return self::execute($sql, [$id]); 
    }
    
    public static function getPosts($offset, $status){
        $sql = "SELECT * FROM posts WHERE status $status LIMIT 10 OFFSET $offset";
		return self::execute($sql, []);
    }
    
    public static function countPosts($status){
        $sql = "SELECT COUNT(*) as c FROM posts WHERE status $status";
		$result = self::execute($sql, []);
		$result = $result->fetch(PDO::FETCH_ASSOC);
		return  $result['c'];
    }
    
    public function insert(){
        // check duplicated title
        $isExist = $this->checkTitleExist($this->title);
        if($isExist == true) {
            throw new Exception("Sorry! Title '". $this->title . "' is used already!!!");
        }
        // more validate
        //==============
        $this->date_created = $this->date_modified = strtotime('now');
        $sql = 'INSERT INTO posts (title, body, date_created, date_modified) VALUES (?, ?, ?, ?)';
        self::execute($sql, [$this->title, $this->body, $this->date_created, $this->date_modified]);
    }
    
    /*
    * @param Varchar title
    * @return Boolen true = exist| false = no
    */
    public function checkTitleExist($title){
        $sql = "SELECT EXISTS(SELECT 1 FROM posts WHERE title = ? LIMIT 1) as t";
        $result = self::execute($sql, [$title]);;
		$result = $result->fetch(PDO::FETCH_ASSOC);
		return  $result['t'];
    }
}