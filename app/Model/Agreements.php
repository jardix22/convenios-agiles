<?php
class Agreements extends AppModel
{
  public function duration($id) {
    $start = new DateTime($this->field('expired_date', array('id' => $id));
    $end = new DateTime();
    return $start->diff($end);
  }
}