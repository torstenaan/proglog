<?php
include 'database\db_conn.php';

if(array_key_exists('type', $_POST)) {
    $type_name = htmlspecialchars($_POST['type']);

    $query = 'INSERT INTO types (name) VALUES (:name)';

    $values = array(
        ':name' => $type_name,
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
}

$query = 'SELECT * FROM types';

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

<form action="typeForm.php" method="post">
 <p>Type: <input type="text" name="type"/></p>
 <p><input type="submit" value="Add"/></p>
</form>

<a href="index.php">
    <button type="button">Back</button>
</a>