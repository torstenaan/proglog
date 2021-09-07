<?php
$directory = getcwd() . '\imports';
$files = array_diff(scandir($directory), array('..', '.'));
?>

<form action="import.php" method="post">
    <p><select name="file">
    <?php foreach ($files as $file): ?>
        <option><?=$file?></option>
    <?php endforeach ?><p>    
    <p><input type="submit" name="import" value="Import"/></p>
</form>

<?php
include 'domain\activity.php';
include 'domain\subject.php';
include 'domain\activitySubject.php';
include 'controllers\typeController.php';

if(array_key_exists('import', $_POST) && array_key_exists('file', $_POST)) {
    $file = htmlspecialchars($_POST['file']);
    if($file !== ""){
        if (($handle = fopen($directory . '\\' . $file, "r")) !== FALSE) {
            $headers = fgetcsv($handle, 1000, ",");
            if($headers[0] == "Date" 
                && $headers[1] == "Subjects" 
                && $headers[2] == "Type"
                && $headers[3] == "Link"
                && $headers[4] == "Duration" 
                && $headers[5] == "Comment"){
            
                while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $subjects = explode(", ", $row[1]);
                    $type_name = $row[2];
                    $link = $row[3];
                    $duration = $row[4];
                    $comment = $row[5];

                    $date_string = $row[0];
                    $date_array = explode('-', $date_string);
                    $date = mktime(0, 0, 0, $date_array[1], $date_array[0], $date_array[2]);
                    $date = date("Y-m-d", $date);

                    $typeId = TypeController::get_type_id($type_name);

                    
                    // insert activity
                    $activity = new Activity();
                    $activity->set_date($date);
                    $activity->set_type_id($typeId);
                    $activity->set_link($link);
                    $activity->set_duration($duration);
                    $activity->set_comment($comment);
                    $activityId = $activity->insert_activity();
                    
                    // check if subjects exists
                    // if not insert subject
                    // get subjectIds
                    // insert activitySubjects                    
                    foreach($subjects as $subject_name){
                        $subject = new Subject();
                        $subject->set_name($subject_name);
                        $subjectId = $subject->exists();
                        if(!$subjectId){
                            $subjectId = $subject->insert_subject();
                        }
                        $activitySubject = new ActivitySubject();
                        $activitySubject->set_activityId($activityId);
                        $activitySubject->set_subjectId($subjectId);
                        $activitySubject->insert_activity_subject();
                    }
                }
                fclose($handle);
            }
            else {
                echo "The format is wrong.<br />";
            }
        }
    }
}
?>

<a href="index.php">
    <button type="button">Back</button>
</a>