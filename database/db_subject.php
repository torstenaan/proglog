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
    
    public static function insert_subject() {
        include 'database\db_conn.php';
    
        $query = 'INSERT INTO subjects (name) VALUES (:name)';
    
        $values = array(
            ':name' => $name(),
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
    
        echo "Subject added successfully<br>";
    
        return $pdo->lastInsertId('subjects');
    }
}

?>