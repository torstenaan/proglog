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
        return $typeId;
    }

    public static function get_name($id){
        DB_Type::get_name($id);
    }
}

?>