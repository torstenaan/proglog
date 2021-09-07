<?php

include 'database\db_subject.php';

class Subject {
  private $name;

  function set_name($name) {
    $this->name = $name;
  }
  function get_name() {
    return $this->name;
  }

  function exists() {
    return DB_Subject::exists($this->get_name());
  }

  function insert_subject() {
    return DB_Subject::insert_subject($this->get_name());
  }
}
?>