<?php

include 'domain/subject.php';

class SubjectController {

    public static function get_id($name){
        $subject = new Subject();
        $subject->set_name($name);
        $id = $subject->exists();
        if(!$id){
            $id = $subject->insert($name);
        }
        return $id;
    }

    public static function get_by_activity($activity_id){
        return DB_Subject::get_by_activity($activity_id);
    }

    public static function get_all(){
        return DB_Subject::get_all();
    }

    public static function insert($name){
        return DB_Subject::insert($name);
    }
}

?>