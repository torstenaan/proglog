<?php

class DB_Activity {

    public static function insert($activity) {
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
    
        return $activity_id = $pdo->lastInsertId('activities');
      }

      public static function delete($id){
        include 'database\db_conn.php';

        $query = 'DELETE FROM activities WHERE id = :id;';

        $values = array(
            ':id' => $id,
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
    
        $query = 'DELETE FROM activity_subjects WHERE activityId = :activityId;';
    
        $values = array(
            ':activityId' => $id,
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

    public static function get_all(){
        include 'database\db_conn.php';

        $query = 'SELECT * FROM activities ORDER BY date DESC, Id DESC';

        try
        {
        $res = $pdo->prepare($query);
        
        $res->execute();
        }
        catch (PDOException $e)
        {
        echo 'Query error: ' . $e->getMessage();
        die();
        }

        return $activities = $res->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>