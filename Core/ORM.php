<?php
namespace Core;
use \PDO;
Class ORM{

    private $connexion;

    public function __construct(){
        $this->connexion = new PDO('mysql:host=localhost; dbname=mvc', 'root', 'baptiste02300');
    }

    public function create ($table, $fields) {
        if(isset($table) && isset($fields)){
            if(is_string($table) && is_array($fields)){
                foreach($fields as $key=>$values){
                    $nom[] = $key;
                    $val[] ="'". $values . "'";
                }
                $nom = implode(',', $nom);
                $val = implode(',', $val);
                $sql = $this->connexion->prepare("INSERT INTO $table ($nom) VALUES ($val)");
        
                if($sql->execute()){
                    $last_id = $this->connexion->lastInsertId();
                    return $last_id;
                }
            } else {
                return false;
            }
        } else{
            return false;
        }
    } // retourne un id
    public function read ($table, $id) {
        if(isset($table) && isset($id)){
            if(is_string($table) && is_int($id)){
                $sql = $this->connexion->prepare("SELECT * FROM $table WHERE id = :id");
                $sql->bindParam(':id', $id);
                $sql->execute();
                $requete = $sql->fetch();
                return $requete;
            } else {
                return false;
            }
        }else{
            return false;
        }
    } // retourne un tableau associatif de l'enregistrement
    public function update ($table, $id, $fields) {
        if(isset($table) && isset($id) && isset($fields)){
            if(is_string($table) && is_int($id) && is_array($fields)){
                foreach($fields as $key=>$values){
                    $colonne[] = "$key = '$values'";
                }
                $colonne = implode(",", $colonne);
                $sql = $this->connexion->prepare("UPDATE $table SET $colonne WHERE id = :id");
                $sql->bindParam(':id', $id);
                if($sql->execute()){
                    return true;
                }
            }else {
                return false;
            }
        }else {
            return false;
        }
    } // retourne un booléen
    public function delete ($table, $id) {
        if(isset($table) && isset($id)){
            if(is_string($table) && is_int($id)){
                $sql = $this->connexion->prepare("DELETE FROM $table WHERE id = :id");
                $sql->bindParam(':id', $id);
                if($sql->execute()){
                    return true;
                }
            } else {
                return false;
            }
        }else {
            return false;
        }
    } // retourne un booléen
    public function find ($table, $params = array(
         'WHERE' => '1',
         'ORDER BY' => 'id ASC',
         'LIMIT' => '5'
        )) {
            if(isset($table) && isset($params)){
                if(is_string($table) && is_array($params)){
                    foreach($params as $key=>$values){
                        $condition[] = $key ." ".$values;
                    }
                    $condition = implode(" ", $condition);
                    $sql = $this->connexion->prepare("SELECT * FROM $table $condition");
                    $requete = $sql->execute();
                    if($requete != false){
                        while($row = $sql->fetch()){
                            $test[] = $row;
                        }
                        return $test;
                    }
                }else{
                    return false;
                }
            }else {
                return false;
            }
        } // retourne un tableau d'enregistrements
}
?>