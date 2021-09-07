<?php
include 'database\db_conn.php';

if(array_key_exists('subject', $_POST)) {
    $subject_name = htmlspecialchars($_POST['subject']);

    $query = 'INSERT INTO subjects (name) VALUES (:name)';

    $values = array(
        ':name' => $subject_name,
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
}

$query = 'SELECT * FROM subjects';

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

while ($row = $res->fetch(PDO::FETCH_ASSOC))
{
   echo $row['name'] . '<br>';
}
?>

<form action="subjectForm.php" method="post">
 <p>Subject: <input type="text" name="subject"/></p>
 <p><input type="submit" value="Add"/></p>
</form>

<a href="index.php">
    <button type="button">Back</button>
</a>