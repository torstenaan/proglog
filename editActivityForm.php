<?php

include 'controllers\activityController.php';
include 'controllers\subjectController.php';
include 'controllers\typeController.php';

$id = htmlspecialchars($_POST['id']);

$activity = ActivityController::get($id);
$subjects = SubjectController::get_all();
$types = TypeController::get_all();
$selected_subjects = array_column(SubjectController::get_by_activity($id), 'name');
$selected_type = TypeController::get_name($activity['typeId']);

?>

<form action="editActivityAction.php" method="post">
    <input type="hidden" name="id" value="<?php echo $activity['id']; ?>"/>
    <input type="date" name="date"
       value="<?= $activity['date'] ?>" />
    <p><select name="subject_names[]" id="subject_ids" multiple>
    <?php foreach ($subjects as $subject){
        $subject_name = $subject['name'];
        if(in_array($subject_name,$selected_subjects)) {
            echo "<option selected value='$subject_name'>$subject_name</option>";
        }
        else {
            echo "<option>$subject_name</option>";
        }
    }?>
    </select></p>

    <p><select name="type_name" id="type_id">
    <?php foreach ($types as $type){
        $type_name = $type['name'];
        if($type_name == $selected_type) {
            echo "<option selected value='$type_name'>$type_name</option>";
        }
        else {
            echo "<option>$type_name</option>";
        }
    }?>
    </select></p>

    <p>Link: <input type="text" name="link" value="<?= $activity['link'] ?>" /></p>
    <p>Duration: <input type="text" name="duration" value="<?= $activity['duration'] ?>" /></p>
    <p>Comment: <input type="text" name="comment" value="<?= $activity['comment'] ?>"" /></p>
    <p><input type="submit" name="confirm" value="Confirm"/></p>
</form>

<a href="index.php">
    <button type="button">Back</button>
</a>