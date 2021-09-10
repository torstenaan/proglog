<?php
include 'controllers\typeController.php';
include 'controllers\subjectController.php';
include 'controllers\activityController.php';
include 'controllers\activitySubjectController.php';

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

$type_id = TypeController::get_id($type_name);

$subject_ids = array();
foreach ($subject_names as $subject_name) {
    $subject_id = SubjectController::get_id($subject_name);
    array_push($subject_ids, $subject_id);
}

$activity_id = ActivityController::insert($date,$type_id,$link,$duration,$comment);

    for($i = 0; $i < count($subject_ids); $i++){
        ActivitySubjectController::insert($activity_id, $subject_ids[$i]);
    }
?>

<a href="index.php">
    <button type="button">Back</button>
</a>