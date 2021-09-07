<?php
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
?>

<form action="activityAction.php" method="post">
    <input type="date" name="date"
       value="2021-08-30"
       min="2021-08-30">

    <p><select name="subject_names[]" id="subject_ids" multiple>
    <?php foreach ($subjects as $row): ?>
        <option><?=$row["name"]?></option>
    <?php endforeach ?>
    </select></p>

    <p><select name="type_name" id="type_id">
    <?php foreach ($types as $row): ?>
        <option><?=$row["name"]?></option>
    <?php endforeach ?>
    </select></p>
    <p>Link: <input type="text" name="link"/></p>
    <p>Duration: <input type="text" name="duration"/></p>
    <p>Comment: <input type="text" name="comment"/></p>
    <p><input type="submit" value="Add"/></p>
</form>


<a href="index.php">
    <button type="button">Back</button>
</a>