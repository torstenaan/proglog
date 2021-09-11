<?php

class DB_Stats {
    public static function get_summed_duration_per_type(){
        include 'database\db_type.php';
        include 'database\db_conn.php';

        $types = DB_Type::get_all();

        $query = 'SELECT SUM(duration) as total';
        foreach($types as $type){
            $query .= ', SUM(CASE WHEN typeId = ' . $type['id'] . ' THEN duration ELSE 0 END) as "' . $type['name'] . '"';
        }
        $query .= ' FROM activities';

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
        return ($res->fetch(PDO::FETCH_ASSOC));
    }
}

?>