<?php
require_once 'models/database.php';
?>
<div class="container">
	<div class="col-xs-6" style="text-align: left; color: #37699a">
		<div class="level logo_kpi"></div>
	</div>
</div>
<div class="container" style= "margin-top: 150px; width: 90%">
	<div class="container" align="center">
		<form id="loginform" class="form-horizontal" name="login" method="post" action="">
		    <?php 
                if ($data['success'] == false) {
                    echo sprintf('<div class="alert alert-danger col-sm-offset-3 col-sm-6" role="alert"><strong>エラー：</strong>%s</div>', $data['message']);
                }               
             ?>
			<div class="form-group">
		    	<label for="inputuser_id" class="col-sm-offset-3 col-xs-offset-3 col-sm-2 col-xs-4 control-label titlehoz" style="width: 120px;padding: 7px;">User ID:</label>
      			<div class="col-sm-5 col-xs-8">
      			   <input type="text" class="form-control" id="inputuser_id" autofocus name="user_id" value="<?php  echo ($_POST['user_id'] != "" ? $_POST['user_id'] : $_GET['user_id']) ?>"></input>
      			</div>
		  	</div>
		  	<div class="form-group">
    			<label for="inputpassword" class="col-sm-offset-3 col-xs-offset-3 col-sm-2 col-xs-4 control-label titlehoz" style="width: 120px;padding: 7px;">Password:</label>
		      	<div class="col-sm-5 col-xs-8">
		      	    <input type="password" class="form-control" id="inputpassword" name="password" ></input>
	      	    </div>
		    </div>
	  		<div class="form-group">
			  	<div class="col-sm-offset-4 col-xs-offset-4 col-sm-5 col-xs-8"  style="text-align:center;">
	            	<button type="submit" class="btn btn-default" name="submit" value="login"><?php echo _("Đăng nhập"); ?></button>
	           	</div>
          	</div>
	        <?php
                if($data['user_id_error_message'] != null)
                echo sprintf('<span class="help-block">%s</span>',$data['user_id_error_message']);
            ?>

		    <?php
                if($data['password_error_message'] != null)
                echo sprintf('<span class="help-block">%s</span>',$data['password_error_message']);
	         ?>
		</form>   
     </div>
</div>