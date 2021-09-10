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

    public static function insert($name) {
        include 'database\db_conn.php';

        $query = 'INSERT INTO types (name) VALUES (:name)';
    
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
    
        return $pdo->lastInsertId('types');
    }

    public static function get_name($id){
        include 'database\db_conn.php';

        $query = 'SELECT * FROM types WHERE id = :id';

        $values = array(
            ':id' => $id
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
        return ($res->fetch())['name'];
    }

    public static function get_all(){
        include 'database\db_conn.php';
        
        $query = 'SELECT * FROM types';
        
        try
        {
            $res = $pdo->prepare($query);
            $res->execute();
            $types = $res->fetchAll();
        }
        catch (PDOException $e)
        {
            echo 'Query error: ' . $e->getMessage();
            die(); 
        }
        return $types;
    }
}

?>