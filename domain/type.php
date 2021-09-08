<?php

include 'database\db_type.php';

class Type {
  private $name;

  function set_name($name) {
    $this->name = $name;
  }
  function get_name() {
    return $this->name;
  }

  function exists() {
    return DB_Type::exists($this->get_name());
  }

  function insert() {
    return DB_Type::insert($this->get_name());
  }
}
?>