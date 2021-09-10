<?php

// query to get duration for total and for the first 4 types
//SELECT SUM(duration) as total, SUM(CASE WHEN typeId = 1 THEN duration ELSE 0 END) as type1, SUM(CASE WHEN typeId = 2 THEN duration ELSE 0 END) as type2, SUM(CASE WHEN typeId = 3 THEN duration ELSE 0 END) as type3, SUM(CASE WHEN typeId = 4 THEN duration ELSE 0 END) as type4 FROM activities;

// query to get duration for total and for the first 4 subjects
// total makes no sense with overlapping subjects
//SELECT SUM(duration) as total, SUM(CASE WHEN activity_subjects.subjectId = 1 THEN duration ELSE 0 END) as subject1, SUM(CASE WHEN activity_subjects.subjectId = 2 THEN duration ELSE 0 END) as subject2, SUM(CASE WHEN activity_subjects.subjectId = 3 THEN duration ELSE 0 END) as subject3 FROM activities INNER JOIN activity_subjects ON activities.id = activity_subjects.activityId;

?>

<a href="index.php">
    <button type="button">Back</button>
</a>