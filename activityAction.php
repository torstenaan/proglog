<?php
include 'database\db_conn.php';

    echo "<pre>";print_r($_POST);echo "</pre>";

    $subject_names = array();
    foreach ($_POST['subject_names'] as $name)
    {
            array_push($subject_names, $name);
    }
    $date = $_POST['date'];
    $type_name = htmlspecialchars($_POST['type_name']);
    $link = htmlspecialchars($_POST['link']);
    $duration = (int)($_POST['duration']);
    $comment = htmlspecialchars($_POST['comment']);


    // Get type id
    $query = 'SELECT * FROM types WHERE name = :type_name';

    $values = array(
        ':type_name' => $type_name
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
    $type_id = ($res->fetch())['id'];

    // Get subject ids
    $subject_ids = array();
    foreach ($subject_names as $name) {
        $query = 'SELECT * FROM subjects WHERE name = :subject_name';

        $values = array(
            ':subject_name' => $name
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
        array_push($subject_ids, ($res->fetch())['id']);
    }

    //Insert activity
    $query = 'INSERT INTO activities (date, typeId, link, duration, comment) VALUES (:date, :type_id, :link, :duration, :comment)';

    $values = array(
        ':date' => $date,
        ':type_id' => $type_id,
        ':link' => $link,
        ':duration' => $duration,
        ':comment' => $comment
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
    $activity_id = $pdo->lastInsertId('activities');

    echo "Acvity added successfully<br>";

    for($i = 0; $i < count($subject_ids); $i++){
        $query = 'INSERT INTO activity_subjects (activityId, subjectId) VALUES (:activity_id, :subject_id)';

        $values = array(
            ':activity_id' => $activity_id,
            ':subject_id' => $subject_ids[$i]
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
        echo "Acvity_subject added successfully<br>";
    }
?>

<a href="activityForm.php">
    <button type="button">Back</button>
</a>