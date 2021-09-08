<nav>
    <a href="/proglog/activityForm.php">Activity</a> |
    <a href="/proglog/subjectForm.php">Subject</a> |
    <a href="/proglog/typeForm.php">Type</a> |
    <a href="/proglog/stats.php">Stats</a> |
    <a href="/proglog/import.php">Import</a> 
</nav>

<?php
include 'controllers\activityController.php';
include 'controllers\typeController.php';
include 'controllers\subjectController.php';

if(array_key_exists('delete', $_POST)) {
    $delete_id = htmlspecialchars($_POST['id']);
    ActivityController::delete($delete_id);
}

$activities = ActivityController::get_all();
?>

<table border="1">
    <tr>
        <th>Date</th>
        <th>Subjects</th>
        <th>Type</th>
        <th>Link</th>
        <th>Duration</th>
        <th>Comment</th>
    </tr>
<?php
for($i = 0; $i < count($activities); $i++)
{ 
    $type = TypeController::get_name($activities[$i]['typeId']);

    $activity_id = $activities[$i]['id'];

    $subjects = SubjectController::get_by_activity($activity_id);
    
    ?>
    <tr>
        <td><?=$activities[$i]['date']?></td>
        <td><?=$subjects?></td>
        <td><?=$type?></td>
        <td><?=$activities[$i]['link']?></td>
        <td><?=$activities[$i]['duration']?></td>
        <td><?=$activities[$i]['comment']?></td>
        <td>
            <form method="post" action="editActivity.php">
                <input type="submit" name="edit" value="E"/>
                <input type="hidden" name="id" value="<?php echo $activity_id; ?>"/>
            </form>
            <form method="post" action="index.php">
                <input type="submit" name="delete" value="D"/>
                <input type="hidden" name="id" value="<?php echo $activity_id; ?>"/>
            </form>
        </td>
    </tr>
<?php
}
?>

</table>