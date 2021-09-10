<?php

include 'controllers\subjectController.php';
include 'controllers\typeController.php';

$subjects = SubjectController::get_all();
$types = TypeController::get_all();

?>

<form action="activityAction.php" method="post">
    <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>">

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