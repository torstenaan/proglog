<?php

include 'domain/activity.php';

class ActivityController {

    public static function insert($date,$typeId,$link,$duration,$comment){
        $activity = new Activity();
        $activity->set_date($date);
        $activity->set_type_id($typeId);
        $activity->set_link($link);
        $activity->set_duration($duration);
        $activity->set_comment($comment);
        return $activity->insert();
    }

    public static function delete($id){
        $activity = new Activity();
        $activity->set_id($id);
        $activity->delete();
    }

    public static function get_all(){
        return DB_Activity::get_all();
    }
}

?>
                    
                    
                    