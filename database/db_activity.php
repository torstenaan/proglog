<?php

class DB_Activity {

    public static function insert_activity($activity) {
        include 'database\db_conn.php';
    
        $query = 'INSERT INTO activities (date, typeId, link, duration, comment) VALUES (:date, :type_id, :link, :duration, :comment)';
    
        $values = array(
            ':date' => $activity->get_date(),
            ':type_id' => $activity->get_type_id(),
            ':link' => $activity->get_link(),
            ':duration' => $activity->get_duration(),
            ':comment' => $activity->get_comment()
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
      
        echo "Acvity added successfully<br>";
    
        return $activity_id = $pdo->lastInsertId('activities');
      }
}

?>