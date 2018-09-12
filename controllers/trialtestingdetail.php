<?php
// require_once "controllers/kpi.php";

class TrialtestingdetailController extends BaseController
{
    function __construct ($route, $urlValues) {
        parent::__construct ($route, $urlValues);
    }
    
    protected function index()
    {
        if(!empty($_GET["chooseLevel"]) && !empty($_GET["chooseExamCode"])){
            $this->setData("chooseLevel", $_GET["chooseLevel"]);
            $this->setData("chooseExamCode", $_GET["chooseExamCode"]);
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['submit'] == 'trial_test')) {
            $this->setData("chooseLevel", $_POST["chooseLevel"]);
            $this->setData("chooseExamCode", $_POST["chooseExamCode"]);
            //get Data with chooseLevel + chooseExamCode
            //set $this->setData()
            
            $listRequest = Data::getTrialTestingRequest($_POST['chooseLevel']);
            $this->setData('listRequest', $listRequest);
            
            $listQuestion = Data::getTrialTestingExam($_POST['chooseLevel'], $_POST["chooseExamCode"]);
            $this->setData('listQuestion', $listQuestion);
            
            $listItem = Data::getListType($_POST['chooseLevel'], $_POST["chooseExamCode"]);
            $this->setData('listItem', $listItem);
            
            $mondai_list_temp = array();
            foreach ($listItem as $key => $value) {
                $numOfMondai = Data::getListMondai($_POST['chooseLevel'], $_POST["chooseExamCode"], $value["type_id"]);
                array_push($mondai_list_temp, $numOfMondai);
            }
            $this->setData('listMondai', $mondai_list_temp);
            
            $result_test = array();
            $answer_test = array();
            
            //set result for this listVocab test
            for($i = 0; $i < count($listQuestion); $i++){
                $result_test[$i] = $listQuestion[$i]['answer_correct'];
                $answer_test[$i] = "";
            }
            
            $this->setData("listQuestion_result", $result_test);
            $this->setData("listQuestion_answer", $answer_test);
        }

        $this->render();      
    }
}
?>