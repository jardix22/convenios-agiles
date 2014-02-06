<?php

class Lifeline extends AppModel
{	
	/**
	 *
	 * Register all action that the users can do in agreements states
	 *
	 * @agreement_id => Someone id Agreement
	 * @state => ['created', 'modified', 'deleted']
	 *
	 */
	public function Push($agreement_id=null, $state=null, $user_id=null)
	{
		if ($user_id) {
			$data = array('agreement_id' => $agreement_id, 'state' => $state, 'when' => date("Y/m/d H:i:s"), 'user_id' => $user_id);
			$result = $this->save($data);
			if (!$result){
				throw new NotFoundException("can't lifeline save");
			}
		}else{
			throw new ForbiddenException("user does't exist");
		}
	}
}