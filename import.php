<form action="import.php" method="post" enctype="multipart/form-data">
  Select csv to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" name="upload" value="Upload">
</form>

<?php
if(isset($_POST["upload"])) {
    $target_dir = "imports/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploadOk = 1;
    if (file_exists($target_file)) {
        echo "File already exists.";
        $uploadOk = 0;
    }
    if($fileType != 'csv'){
        echo "Wrong file format.";
        $uploadOk = 0;
    }
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

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

include 'controllers\typeController.php';
include 'controllers\activityController.php';
include 'controllers\subjectController.php';
include 'controllers\activitySubjectController.php';

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
            
                $count = 0;
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

                    $typeId = TypeController::get_id($type_name);
                    $activityId = ActivityController::insert($date,$typeId,$link,$duration,$comment);
               
                    foreach($subjects as $subject_name){
                        $subjectId = SubjectController::get_id($subject_name);
                        ActivitySubjectController::insert($activityId, $subjectId);
                    }
                    $count++;
                }
                fclose($handle);

                echo "Import completed. " . $count . " entries added.<br />";
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