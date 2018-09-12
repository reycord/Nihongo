<?php
// require_once "controllers/kpi.php";

class TestingController extends BaseController
{
    function __construct ($route, $urlValues) {
        parent::__construct ($route, $urlValues);
    }
     
    protected function index()
    {
        $this->setData('success', true);
        
        $listLevel = Data::getCertificate();
        $this->setData('listLevel', $listLevel);
        
        $listLesson = Data::getLesson();
        $this->setData('listLesson', $listLesson);
        
        if(!empty($_GET['chooseLevel'])){
            $_POST['chooseLevel'] = $_GET['chooseLevel'];
        }
        if(!empty($_GET['chooseLesson'])){
            $_POST['chooseLesson'] = $_GET['chooseLesson'];
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['submit'] == 'test' || $_POST['submit'] == 'study')) {
            // $listVocab = Data::getVocabByLessonId($_POST['chooseLevel'], $_POST['chooseLesson']);
            if($_POST['submit'] == 'test'){
                $listVocab = Data::getVocabByLevelAndLessonId($_POST['chooseLevel'], $_POST['chooseLesson']);
                $this->setData('listVocab', $listVocab);
                
                $result_vocab_test = array();
                $result_vocab1_test = array();
                $result_vocab2_test = array();
                $answer_vocab_test = array();
                $answer_vocab1_test = array();
                $answer_vocab2_test = array();
                
                //set result for this listVocab test
                for($i = 0; $i < count($listVocab); $i++){
                    $dice = rand(1, 4);
                    $result_vocab_test[$i] = $dice;
                    $answer_vocab_test[$i] = 0;
                }
                for($i = 0; $i < count($listVocab); $i++){
                    $dice = rand(1, 4);
                    $result_vocab1_test[$i] = $dice;
                    $answer_vocab1_test[$i] = 0;
                }
                for($i = 0; $i < count($listVocab); $i++){
                    $dice = rand(1, 4);
                    $result_vocab2_test[$i] = $dice;
                    $answer_vocab2_test[$i] = 0;
                }
                
                $this->setData("listVocab_result", $result_vocab_test);
                $this->setData("listVocab_answer", $answer_vocab_test);
                $this->setData("listVocab1_result", $result_vocab1_test);
                $this->setData("listVocab1_answer", $answer_vocab1_test);
                $this->setData("listVocab2_result", $result_vocab2_test);
                $this->setData("listVocab2_answer", $answer_vocab2_test);
            
            } elseif($_POST['submit'] == 'study'){
                $string_temp = "?c=learning&chooseLevel=" . $_POST['chooseLevel'] . "&chooseLesson=" . $_POST['chooseLesson'];
                $this->redirectTo($string_temp);
                // $this->render('learning/index'); // pass data to view but view has no template 
                exit;
            }
            
            $this->setData("chooseLevel", $_POST['chooseLevel']);
            $this->setData("chooseLesson", $_POST['chooseLesson']);
        }
        
        $this->render();      
    }
}
?>