<?php
require_once "config/lang_config.php";
class UserController extends BaseController
{    
    
    //add to the parent constructor
    public function __construct($route, $urlValues) {
        parent::__construct($route, $urlValues);
    }
	
    protected function index() {
    	$this->setData('success', true);
	    $Data= User::getCurrentUser();
	    $Levelhoc = $Data->next_level;
	    $user_id = $Data->user_id;
	    $tam = 1;
	    if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['LessonLevel']) ){
	    	$this->setData('success', true);
			$Levelhoc = $_POST['LessonLevel'];
			$this->setData('Levelhoc', $Levelhoc);
		}
	    //$lesson = Data::getListNameLesson($lessonlevel, $user_id);
	   // $lessonlevel = $_POST['LessonLevel'];
	    $level= Data::getCertificate();
	    $type_content = Data::getTypeContent();
	    $lesson = Data::getListNameLesson($Levelhoc, $user_id);
	    $this->setData('lesson',$lesson);
	    $this->setData('type_content', $type_content);
	    $this->setData('listLevel',$level);
	    $this->setData('user',$Data);
	    
	  	if (isset($_POST['hoctuvung'])) {
	     	$string_temp = "?c=learning&a=index&Lesson_id=".$_POST['hoctuvung']."&Level=".$Levelhoc."&type=".$type_content["0"]["type_content"];
			$this->redirectTo($string_temp);
	    }
	    if (isset($_POST['kiemtra'])) {
	    	$string_temp = "?c=testing&chooseLevel=" . $_POST['LessonLevel'] . "&chooseLesson=" . $_POST['kiemtra'];
			$this->redirectTo($string_temp);	
	    }
	    if (isset($_POST['hocnguphap'])) {
	     	$string_temp = "?c=learning&a=index&Lesson_id=".$_POST['hocnguphap']."&Level=".$Levelhoc."&type=".$type_content["1"]["type_content"];
			$this->redirectTo($string_temp);
	    }
	    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['luu'] =='luu' && isset($_POST['present_level']) && isset($_POST['next_level'])){
	    	//echo '<script language="javascript"> alert("nut luu dang duoc nhan"); </script>';
					$this->setData('success', true);
					$tam = 1;
					$this->setData('tam',$tam);

			    	$present_level = $_POST['present_level'];
			    	$next_level = $_POST['next_level'];
			  		if ($next_level > $present_level) {
			  		echo '<script language="javascript"> alert("Level hiện tại phải nhỏ hơn Level mục tiêu"); </script>';
			  		}
			  		else
			  		{
			  			User::editLevel($user_id,$present_level,$next_level);
			    		header("Refresh:0");
			  		}
			    	
			    	
		}
		$this->setData('tam',$tam);
		

	    $this->render();
	}
}
?>