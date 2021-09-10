<?php

include 'database/db_activity.php';

class Activity {
  private $id;
  private $date;
  private $type_id;
  private $link;
  private $duration;
  private $comment;

  function set_id($id){
    $this->id = $id;
  }

  function get_id(){
    return $this->id;
  }

  function set_date($date) {
    $this->date = $date;
  }
  
  function get_date() {
    return $this->date;
  }

  function set_type_id($type_id) {
    $this->type_id = $type_id;
  }
  
  function get_type_id() {
    return $this->type_id;
  }

  function set_link($link) {
    $this->link = $link;
  }

  function get_link() {
    return $this->link;
  }

  function set_duration($duration) {
    $this->duration = $duration;
  }
  
  function get_duration() {
    return $this->duration;
  }

  function set_comment($comment) {
    $this->comment = $comment;
  }
  
  function get_comment() {
    return $this->comment;
  }

  function insert() {
    return DB_Activity::insert($this);
  }

  function delete() {
    DB_Activity::delete($this->get_id());
  }

  function update(){
    return DB_Activity::update($this);
  }
}
?>