<?php
include 'controllers\subjectController.php';

if(array_key_exists('subject', $_POST)) {
    $subject_name = htmlspecialchars($_POST['subject']);

    SubjectController::insert($subject_name);
}

$subjects = SubjectController::get_all();

foreach($subjects as $subject)
{
    echo $subject['name'] . "<br />";
}

?>

<form action="subjectForm.php" method="post">
 <p>Subject: <input type="text" name="subject"/></p>
 <p><input type="submit" value="Add"/></p>
</form>

<a href="index.php">
    <button type="button">Back</button>
</a>