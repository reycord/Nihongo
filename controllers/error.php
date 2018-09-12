<?php

class ErrorController extends BaseController
{    
    //add to the parent constructor
    public function __construct($route, $urlValues) {
        parent::__construct($route, $urlValues);
        
    }
    
    //bad URL request error
    protected function badURL()
    {
        $this->view->output();
    }

    protected function badURL_json()
    {
        $result = array(
            'success' => false, 
            'code' => ERR_BADURL_CD,
            'message' => __('あなたが要求したURLが存在しません。'),
        );
        echo json_encode($result);
    }
}

?>
