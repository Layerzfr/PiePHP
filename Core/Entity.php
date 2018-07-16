<?php
namespace Core;
Class Entity extends ORM{
    public function __construct($array){
         if(is_array($array)){
            foreach($array as $key=>$value){
                $this->{$key} = $value;
            }
        }
        else{
            $dataAr = $this->read(NULL, $array);
            foreach($dataAr as $key=>$value){
                $this->{$key} = $value;
            }
        }
    }
}

?>