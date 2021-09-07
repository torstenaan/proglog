<nav>
    <a href="/proglog/activityForm.php">Activity</a> |
    <a href="/proglog/subjectForm.php">Subject</a> |
    <a href="/proglog/typeForm.php">Type</a> |
    <a href="/proglog/stats.php">Stats</a> |
    <a href="/proglog/import.php">Import</a> 
</nav>

<?php

include 'database\db_conn.php';

$query = 'SELECT * FROM activities ORDER BY date ASC, Id ASC';

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

$activities = $res->fetchAll(PDO::FETCH_ASSOC);
for($i = 0; $i < count($activities); $i++)
{ 
    // Get type
    $query = 'SELECT * FROM types WHERE id = :type_id';

    $values = array(
        ':type_id' => $activities[$i]['typeId']
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
    $type = ($res->fetch())['name'];

    // Get subjects
    $query = 'SELECT name
        FROM subjects
        INNER JOIN activity_subjects 
        ON subjects.id = activity_subjects.subjectId
        AND activity_subjects.activityId = :activity_id';
    
    $values = array(
        ':activity_id' => $activities[$i]['id']
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
    $subjects = substr($subjects, 0, -2);
    
    ?><table border="1">
        <tr>
            <th>Date</th>
            <td><?=$activities[$i]['date']?></td>
        </tr>
        <tr>
            <th>Subjects</th>
            <td><?=$subjects?></td>
        </tr>
        <tr>
            <th>Type</th>
            <td><?=$type?></td>
        </tr>
        <tr>
            <th>Link</th>
            <td><?=$activities[$i]['link']?></td>
        </tr>
        <tr>
            <th>Duration</th>
            <td><?=$activities[$i]['duration']?></td>
        </tr>
        <tr>
            <th>Comment</th>
            <td><?=$activities[$i]['comment']?></td>
        </tr>
    </table>
<?php
}
?>