<?php

include 'domain/activitySubject.php';

class ActivitySubjectController {

    public static function insert($activity_id, $subject_id){
        $activitySubject = new ActivitySubject();
        $activitySubject->set_activityId($activity_id);
        $activitySubject->set_subjectId($subject_id);
        $activitySubject->insert($activity_id, $subject_id);
    }

    public static function delete($activity_id, $subject_id){
        DB_ActivitySubject::delete($activity_id, $subject_id);
    }
}

?>