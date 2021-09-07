<?php

include 'domain/type.php';

class TypeController {

    public static function get_type_id($type_name){
        $type = new Type();
        $type->set_name($type_name);
        $typeId  = $type->exists();
        if(!$typeId){
            $typeId = $type->insert_type();
        }
        return $typeId;
    }
}

?>