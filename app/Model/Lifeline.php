<?php 
/**
* 
*/
class Lifeline extends AppModel
{
	// LifelinePush
	// $agreement_id => Someone id Agreement
	// $state => ['created', 'modified', 'deleted']

	public function Push($agreement_id=null, $state=null, $user_id=null)
	{
		// $this->loadModel('Lifeline');
		$data = array('agreement_id' => $agreement_id, 'state' => $state, 'when' => date("Y/m/d H:i:s"), 'user_id' => $user_id);
		$result = $this->save($data);

		if (!$result){
			throw new NotFoundException(__('Invalid lifeline saving'));
		}
	}
}
 ?>