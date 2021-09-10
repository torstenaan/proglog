<?php

include 'domain/type.php';

class TypeController {

    public static function get_id($name){
        $type = new Type();
        $type->set_name($name);
        $id  = $type->exists();
        if(!$id){
            $id = $type->insert();
        }
        return $id;
    }

    public static function get_name($id){
        return DB_Type::get_name($id);
    }

    public static function get_all(){
        return DB_TYPE::get_all();
    }

    public static function insert($name){
        return DB_Type::insert($name);
    }
}

?>