<?php 
require_once "config/lang_config.php";

class AuthenticateController extends BaseController
{
     //add to the parent constructor
    public function __construct($route, $urlValues) {
        parent::__construct($route, $urlValues);
    }
	
    //bad URL request error
    protected function login()
    {
    	// $this->setData('companyList', Company::getCompanyList());
        if ($_POST['submit'] == 'login') {
			$error_list = array();
			$this->setData('success', true);
            
			if (empty($_POST['user_id'])) {
				$this->setData('success', false);
				$this->setData('user_id_error', true);
				$this->setData('password_error', true);			
				$error_list[] = ' ユーザー, パスワード';
			} elseif (empty($_POST['password'])) {
				$this->setData('success', false);
				$this->setData('password_error', true);
				$error_list[] = ' パスワード';
            }
			
            // message loi
			if ($this->data['success'] == false) {
            	$this->data['message'] = getMessageById("112", implode(",", $error_list));
			} elseif ($this->data['success'] == true) {
				$user_id = $_POST['user_id'];
				$password = $_POST['password'];
	        
                $loginsuccess = User::logIn($user_id, $password);
	            if ($loginsuccess) {
                    $location = $this->route->url('home');
					
                    if (isset($_GET['location'])) {
                        $location = $_GET['location'];
                    }

                    header("Location: $location");
                    exit();
	            } else {
	            	$this->setData('success', false);
	                $this->data['message'] = getMessageById("202");
	            }	
			}
        }

        $this->render('login');
    }

    protected function logout(){
		$user_id = User::getCurrentUser()->user_id;
        User::logOut();
        $location = $this->route->url("authenticate", "login", array("user_id" => $user_id));
        header("Location: $location");
		
        exit();
    }
}
 ?>