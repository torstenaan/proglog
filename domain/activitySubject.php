<?php

include 'database\db_activitySubject.php';

class activitySubject {
  private $activityId;
  private $subjectId;

  function set_activityId($activityId) {
    $this->activityId = $activityId;
  }
  function get_activityId() {
    return $this->activityId;
  }

  function set_subjectId($subjectId) {
    $this->subjectId = $subjectId;
  }
  function get_subjectId() {
    return $this->subjectId;
  }

  function insert_activity_subject() {
    return DB_ActivitySubject::insert_activity_subject($this->get_activityId(), $this->get_subjectId());
  }
}
?>