<?php

include 'controllers\typeController.php';
include 'controllers\subjectController.php';
include 'controllers\activityController.php';
include 'controllers\activitySubjectController.php';

$id = (int)($_POST['id']);
$date = $_POST['date'];
$type_name = htmlspecialchars($_POST['type_name']);
$link = htmlspecialchars($_POST['link']);
$duration = (int)($_POST['duration']);
$comment = htmlspecialchars($_POST['comment']);

$type_id = TypeController::get_id($type_name);

ActivityController::update($id,$date,$type_id,$link,$duration,$comment);

# old subjects
$old_subjects = array_column(SubjectController::get_by_activity($id), 'name');
# new subjects
$new_subjects = array();
if(isset($_POST["subject_names"])) {
    foreach ($_POST['subject_names'] as $name)
    {
        array_push($new_subjects, $name);
    }
}
$subjects_to_be_removed = array();
foreach($old_subjects as $old){
    if(in_array($old, $new_subjects) == false){
        array_push($subjects_to_be_removed, $old);
    }
}
$subjects_to_be_added = array();
foreach($new_subjects as $new){
    if(in_array($new, $old_subjects) == false){
        array_push($subjects_to_be_added, $new);
    }
}

foreach ($subjects_to_be_removed as $subject_name) {
    $subject_id = SubjectController::get_id($subject_name);
    ActivitySubjectController::delete($id, $subject_id);
}
foreach ($subjects_to_be_added as $subject_name) {
    $subject_id = SubjectController::get_id($subject_name);
    ActivitySubjectController::insert($id, $subject_id);
}

?>

<a href="index.php">
    <button type="button">Back</button>
</a>