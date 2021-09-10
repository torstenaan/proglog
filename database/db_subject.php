<?php

class DB_Subject {

    public static function exists($name) {
        include 'database\db_conn.php';
        
        $query = 'SELECT * FROM subjects WHERE name = :name';
    
        $values = array(
            ':name' => $name,
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
    
        $data = $res->fetch(PDO::FETCH_ASSOC);
        if(!$data) {
            return false;
        }
        else {
            return $data['id'];
        }
      }
    
    public static function insert($name) {
        include 'database\db_conn.php';
    
        $query = 'INSERT INTO subjects (name) VALUES (:name)';
    
        $values = array(
            ':name' => $name,
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
    
        return $pdo->lastInsertId('subjects');
    }

    public static function get_by_activity($activity_id){
        include 'database\db_conn.php';
    
        $query = 'SELECT name
        FROM subjects
        INNER JOIN activity_subjects 
        ON subjects.id = activity_subjects.subjectId
        AND activity_subjects.activityId = :activity_id';
        
        $values = array(
            ':activity_id' => $activity_id
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

        $subjects = "";
        while ($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            $subjects .= $row['name'] . ", ";
        }
        return substr($subjects, 0, -2);
    }

    public static function get_all(){
        include 'database\db_conn.php';
    
        $query = 'SELECT * FROM subjects';
        try
        {
            $res = $pdo->prepare($query);
            $res->execute();
            $subjects = $res->fetchAll();
        }
        catch (PDOException $e)
        {
            echo 'Query error: ' . $e->getMessage();
            die();
        }
        return $subjects;
    }
}

?>