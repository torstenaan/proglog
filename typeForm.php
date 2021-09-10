<?php
include 'controllers\typeController.php';

if(array_key_exists('type', $_POST)) {
    $type_name = htmlspecialchars($_POST['type']);

    TypeController::insert($type_name);
}

$types = TypeController::get_all();

foreach($types as $type)
{
    echo $type['name'] . "<br />";
}

?>

<form action="typeForm.php" method="post">
 <p>Type: <input type="text" name="type"/></p>
 <p><input type="submit" value="Add"/></p>
</form>

<a href="index.php">
    <button type="button">Back</button>
</a>