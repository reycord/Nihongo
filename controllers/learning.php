<?php
//require_once "config/lang_config.php";
class LearningController extends BaseController
{    
	function __construct ($route, $urlValues) {
        parent::__construct ($route, $urlValues);
    }
    protected function index() {
    		$this->setData('success', true);
    	     $user = User::getCurrentUser();
             
             if (isset($_GET['Level'])) {
                 $Levelhoc = $_GET['Level'];
                 $this->setData('Levelhoc', $Levelhoc);
             }
             if (isset($_GET['Lesson_id'])) {
                $lesson_id = $_GET['Lesson_id'];
                $this->setData('lesson_id', $lesson_id);
             }
             if (isset($_GET['type'])) {
                $type= $_GET['type'];
                $this->setData('type',$type);
             }
    	     $lesson = Data::getListNameLesson($Levelhoc, $user->user_id);
             $vocabulary = Data::getVocabularyByIDLesson($lesson_id);
             $grammar = Data::getGrammarByIDLesson($lesson_id); 
             $this->setData('grammar', $grammar);
             $this->setData('vocabulary', $vocabulary);
    	     $this->setData('lesson',$lesson);
    	     $this->setData('user', $user);
             $count = count($vocabulary);
             session_start();
            $_SESSION['count'] = ((isset($_SESSION['count'])) ? $_SESSION['count'] : 0);
    	     if (($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['chuathuoc'] =='chuathuoc')||($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['next'] == 'next')){
                $_SESSION['count']++;
                if ($_SESSION['count']>$count) {
                    unset($_SESSION['count']);
                    $_SESSION['count'] = ((isset($_SESSION['count'])) ? $_SESSION['count'] : 0);
                }
             }
             if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['prev'] =='prev') {
                 $_SESSION['count']--;
                 if ($_SESSION['count']<1) {
                     $_SERVER['count']= $count;
                 }
             }
             // if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['next'] == 'next') {
             //     $_SESSION['count']++;
             //     if ($_SESSION['count']>$count+1) {
             //        unset($_SESSION['count']);
             //    }
             // }
             $tam = $_SESSION['count']-1;
             if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['dathuoc'] =='dathuoc') {
                $vocabulary_id = $vocabulary["$tam"]["vocabulary_id"];
                 Data::updateVocabulary($user->user_id,1,$vocabulary_id);
                 header("Refresh:0");
             }
             if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['kiemtra'] =='kiemtra') {
                $string_temp = "?c=testing&chooseLevel=" . $Levelhoc . "&chooseLesson=" . $lesson_id;
                $this->redirectTo($string_temp);
             }
              
    $this->render();
}
 }
 ?>  