<?php
// require_once "controllers/kpi.php";

class HomeController extends BaseController
{
    protected function index()
    {
		if (User::getCurrentUser()->user_id != null) {
	        $this->setData('success', true);
			//$data = User::getAllUser();
			$data = Data::getUserAndNumberOfStudiedVocabGrammar();
			$this->setData('data', $data);
            
            $dataChart = Data::getDataForChart();
            $this->setData('dataChart', $dataChart);
		}
        
        $this->render();      
    }
}
?>