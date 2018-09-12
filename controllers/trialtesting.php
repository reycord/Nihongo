<?php
// require_once "controllers/kpi.php";

class TrialTestingController extends BaseController
{
    function __construct ($route, $urlValues) {
        parent::__construct ($route, $urlValues);
    }
    
    protected function index()
    {
        // if(!empty($_GET["chooseLevel"]) && !empty($_GET["chooseExamCode"])){
            // $string_temp = "?c=trialtestingdetail&chooseLevel=" . $_GET['chooseLevel'] . "&chooseExamCode=" . $_GET['chooseExamCode'];
            // $this->redirectTo($string_temp);
            // exit;
        // }
        
        $this->render();      
    }
}
?>