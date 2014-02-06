<?php 
/**
* 
*/
class ReportsController extends AppController
{
	public function beforeFilter()
	{
		parent::isAuthenticated();
	}

	public function xls()
	{
		$this->loadModel('Agreement');

		$ids = $this->request->query('ids');
		$idList = explode(",", (string)$ids);
		
		// if (count($idList) > 0) {
			$results = array();
			foreach ($idList as $idItem) {
				$result  = $this->Agreement->find('first', array('conditions' => array('id' => $idItem)));

				$date1 = new DateTime($result['Agreement']['expired_date']);
				$date2 = new DateTime();
				$interval = $date2->diff($date1);
				$is_validity = ($interval->format('%R%a days') < 0) ? "Expirado" : "Vigente";
				$result['Agreement']['is_validity'] = $is_validity;
				
				array_push($results, $result);
			}			
			$this->set('data', $results);
		// }
	}

	public function pdf()
	{
		$this->loadModel('Agreement');

		$ids = $this->request->query('ids');
		$idList = explode(",", (string)$ids);

		// // if (count($idList) > 0) {
			$results = array();
			foreach ($idList as $idItem) {
				$result  = $this->Agreement->find('first', array('conditions' => array('id' => $idItem)));
				// expired state
				$date1 = new DateTime($result['Agreement']['expired_date']);
				$date2 = new DateTime();
				$interval = $date2->diff($date1);
				$is_validity = ($interval->format('%R%a days') < 0) ? "Expirado" : "Vigente";

				$result['Agreement']['is_validity'] = $is_validity;

				array_push($results, $result);
			}			
			$this->set('data', $results);
		// // }

		$this->layout = 'pdf'; //this will use the pdf.ctp layout 
		$this->response->type('pdf');
	}
}
 ?>