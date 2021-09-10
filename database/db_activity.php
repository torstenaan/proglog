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
    
        include 'database\db_activitySubject.php';
        DB_ActivitySubject::delete_all($id);
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
    
    public static function get($id){
        include 'database\db_conn.php';

        $query = 'SELECT * FROM activities WHERE id = :id';
        
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

        return $res->fetch();
    }

    public static function update($activity) {
        include 'database\db_conn.php';
    
        $query = 'UPDATE activities SET date = :date, typeId = :type_id, link = :link,
             duration = :duration, comment = :comment WHERE id = :id';
    
        $values = array(
            ':id' => $activity->get_id(),
            ':date' => $activity->get_date(),
            ':type_id' => $activity->get_type_id(),
            ':link' => $activity->get_link(),
            ':duration' => $activity->get_duration(),
            ':comment' => $activity->get_comment(),
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