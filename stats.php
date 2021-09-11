<?php 

include 'controllers/statsController.php';

print_r(statsController::get_summed_duration_per_type());

?>

<a href="index.php">
    <button type="button">Back</button>
</a>