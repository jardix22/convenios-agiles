<?php
class Agreement extends AppModel
{
  public function beforeSave($options=array())
  {
    if (!empty($this->data['Agreement']['expired_date'])) {
      $this->data['Agreement']['expired_date'] = DateTime::createFromFormat('d/m/Y', $this->data['Agreement']['expired_date'])->format('Y-m-d');
    }
    return true;
  }

  public function duration($id) {
    $start = new DateTime($this->field('expired_date', array('id' => $id)));
    $end = new DateTime();
    return $start->diff($end);
  }
}