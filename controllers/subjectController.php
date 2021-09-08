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
        DB_Subject::get_by_activity($activity_id);
    }
}

?>