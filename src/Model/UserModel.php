<?php
namespace src\Model;
use \PDO;
Class UserModel{
    private $email;
    private $password;
    private $connexion;
    private $id;
    
    public function __construct(){
        $this->connexion = new PDO('mysql:host=localhost; dbname=mvc', 'root', 'baptiste02300');
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    public function setId($id){
        $this->id = $id;
    }
    
    public function save(){
        $sql = $this->connexion->prepare("INSERT INTO users (email, password) VALUES ('$this->email' , '$this->password') ");
        $sql->execute();    
    }
    public function create($set){
        if(isset($set)){
            if(is_array($set)){
                foreach($set as $key=>$value){
                    $col[] = $key;
                    $val[] = "'" . $value . "'";
                }
                $col = implode(",", $col);
                $val = implode(",", $val);
                $sql = $this->connexion->prepare("INSERT INTO users ($col) VALUES ($val) ");
                if($sql->execute()){
                    $last_id = $this->connexion->lastInsertId();
                    return $last_id;
                }
            }else{
                return false;
            }
        }else {
            return false;
        }
    }
    
    public function read($id){
        if(isset($id)){
            if(is_int($id)){
                $sql = $this->connexion->prepare("SELECT * FROM users WHERE id= :id");
                $sql->bindParam(':id', $id);
                if($sql->execute()){
                    $arrayRead = $sql-fetch();
                    return $arrayRead;
                }
            } else {
                return false;
            }
        } else{
            return false;
        }
    }
    
    public function update($id, $set){
        if(isset($id) && isset($set)){
            if(is_int($id) && is_array($set)){
                foreach($set as $key=>$value){
                    $arraySet[] = $key . " = '" . $value . "'";
                }
                $arraySet = implode(",", $arraySet);
                $sql = $this->connexion->prepare("UPDATE users SET $arraySet WHERE id =:id");
                $sql->bindParam(':id', $id);
                if($sql->execute()){
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function delete($id){
        if(isset($id)){
            if(is_int($id)){
                $sql = $this->connexion->prepare("DELETE FROM users WHERE id = :id");
                $sql->bindParam(':id', $id);
                if($sql->execute()){
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function read_all(){
        $sql = $this->connexion->prepare("SELECT * FROM users");
        if($sql->execute()){
            $arrayReadAll = $sql->fetch();
            return $arrayReadAll;
        }
    }
    
    public function log(){
        session_start();
        $_SESSION['email'] = $this->email;
        $_SESSION['password'] = $this->password;
    }
}

?>