<?php
require_once "config/lang_config.php";

class TestController extends BaseController
{    
    
    //add to the parent constructor
    public function __construct($route, $urlValues) {
        parent::__construct($route, $urlValues);
    }
	
    protected function index() {
    	$testdata = Data::getRecord();
		$testcontent = $testdata['user_name'];	
		
		$testdata2 = Data::getMultiRecord();
		foreach ($testdata2 as $key => $row) {
			$testcontent = $testcontent."\n";
            $testcontent = $testcontent."ID：".$row['user_id']."\t";
            $testcontent = $testcontent."Name：".$row['user_name']."\t";
            $testcontent = $testcontent."email：".$row['email']."\t";
            $testcontent = $testcontent."phone：".$row['phone']."\t";
            $testcontent = $testcontent."address：".$row['address']."\t";
            $testcontent = $testcontent."type：".$row['type']."\t";
            $testcontent = $testcontent."day：".$row['signup_day']."\t";
            $testcontent = $testcontent."del：".$row['del_flag']."\t";
        }
		
		/////
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['submit'] =='save' ){
			echo '<script language="javascript"> alert("TESTTTTTTTTTTT2") </script>';
		
		
	       	
		}
		/////

    	$this->view->setData('content', $testcontent);
	    $this->view->output('menu');
	}
		
	protected function getInfo_json()
    {
        $testdata = Data::getRecord();
		$testcontent = $testdata['user_name'];	
		
		$testdata2 = Data::getMultiRecord();
		
        $res = array(
                'success' => true,
                'test_data' => $testdata2,
            );

        echo json_encode($res);
    }
	
	
	
	
}

?>