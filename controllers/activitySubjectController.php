<?php

include 'domain/activitySubject.php';

class ActivitySubjectController {

    public static function insert_activity_subject($activityId, $subjectId){
        $activitySubject = new ActivitySubject();
        $activitySubject->set_activityId($activityId);
        $activitySubject->set_subjectId($subjectId);
        $activitySubject->insert($activityId, $subjectId);
    }
}

?>