<?php

class DB_Type {

    public static function exists($name) {
        include 'database\db_conn.php';
    
        $query = 'SELECT * FROM types WHERE name = :name';
    
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

    public static function insert_type($name) {
        include 'database\db_conn.php';
    
        $query = 'INSERT INTO types (name) VALUES (:name)';
    
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
    
        echo "Type added successfully<br>";
    
        return $pdo->lastInsertId('types');
    }
}

?>