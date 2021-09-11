<?php

include 'database/db_stats.php';

class StatsController {

    public static function get_summed_duration_per_type(){
        return DB_Stats::get_summed_duration_per_type();
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