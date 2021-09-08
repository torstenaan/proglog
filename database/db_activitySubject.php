<?php

class DB_ActivitySubject {

    public static function insert($activityId, $subjectId) {
        include 'database\db_conn.php';
    
        $query = 'INSERT INTO activity_subjects (activityId, subjectId) VALUES (:activityId, :subjectId)';
    
        $values = array(
            ':activityId' => $activityId,
            ':subjectId' => $subjectId
        );
    
        try
        {
            $res = $pdo->prepare($query);
            
            $res->execute($values);
        }
        catch (PDOException $e)
        {
            echo 'Query error: ' . $e->getMessage();
            die();
        }
    }
}

?>