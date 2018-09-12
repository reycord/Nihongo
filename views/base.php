<!DOCTYPE html>
<html lang="ja">
    <head>
    	<meta http-equiv="Content-Type"content="application/xhtml+xml; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css"> -->
        
        <link rel="stylesheet" href="resources/css/bootstrap.min.css">
        <link rel="stylesheet" href="resources/css/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" href="resources/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="resources/css/reset.css">
        <link rel="stylesheet" href="resources/css/style.css">
        <link rel="stylesheet" href="resources/css/styleFlashcard.css">
        
        <link rel="shortcut icon" type="image/x-icon" href="resources/icon/favicon.ico">
        
        <script src="resources/js/jquery.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        
        <script src="resources/js/bootstrap.min.js"></script>
        
        <!-- <script src="resources/js/bootstrap-datepicker.min.js"></script> -->
        <!-- <script src="resources/js/bootstrap-datepicker.ja.min.js"></script> -->
        <script src="resources/js/myFunction.js"></script>
        <script src="resources/js/bootstrap-datepicker.js"></script>
        
        <script src="resources/js/jquery.dataTables.min.js"></script>
        <script src="resources/js/dataTables.bootstrap.min.js"></script>
        <script src="resources/js/dataTables.foundation.min.js"></script>
        <script src="resources/js/dataTables.jqueryui.min.js"></script>
        <script src="resources/js/jsapi.min.js"></script>
        <script src="resources/js/jquery.watermark.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="resources/js/jquery.chained.min.js"></script>

        <title>Nihongo Portal</title>
    </head>
    <body>
    	<div id="page-wrap">
	    	<div class="container" style="height: 62px;" >
	    		<div class="col-xs-5">
					<div class="level logo_kpi"></div>
				</div>
	    	</div>
	        <nav class="navbar navbar-default">
	            <div class="container">
	                <div class="navbar-header" style="width: 100%;">
	                	<ul class="nav navbar-nav" style="float: left; padding-left: 15px;">
	                	    <li <?php if ($this->route->getControllerName() == 'home'): ?>
	                                class="active"
	                            <?php endif ?>>
	                            <a href="<?php echo $this->url("home", "index") ?>">HOME</a>
	                        </li>
	                		<li <?php if ($this->route->getControllerName() == 'user'): ?>
									class="active"
								<?php endif ?>>
	                			<a href="<?php echo $this->url("user","index") ?>">CÁ NHÂN</a>
	                		</li>
	                		<li <?php if ($this->route->getControllerName() == 'learning'): ?>
									class="active"
								<?php endif ?>>
	                			<a href="<?php echo $this->url("learning", "index") ?>">HỌC</a>
	                		</li>                		  
	                        
                            <li <?php if ($this->route->getControllerName() == 'testing'): ?>
									class="active"
								<?php endif ?>>
								<a  href="<?php echo $this->url("testing") ?>">KIỂM TRA</a>
                            </li>
                            
                            <li <?php if ($this->route->getControllerName() == 'trialtesting'): ?>
									class="active"
								<?php endif ?>>
								<a  href="<?php echo $this->url("trialtesting") ?>">THI THỬ</a>
                            </li>
                            
                            <li <?php if ($this->route->getControllerName() == 'admin'): ?>
                                    class="active"
                                <?php endif ?>>
                                
                                <?php if(User::getCurrentUser()->admin_flag == 1): ?>
                                    <a href="<?php echo $this->url("admin") ?>">ADMIN</a>
                                <?php endif ?>
                            </li>
	                    </ul>
	                    <ul class="nav navbar-nav navbar-right" style="float: right;">
	                        <li class="" >
	                        	<p style="font-size:18px; color:#5124F2; padding-top: 5px;"><?php echo ucwords(User::getCurrentUser()->name); ?></p>
                            </li>
	                        <li class="" >
							   <a href="<?php echo $this->url("authenticate", "logout") ?>"><?php echo _("ログアウト") ; ?>
				                </a>       
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </nav>
	        <div class="main">
	            <?php require($this->viewFile); ?>
	        </div>
		</div>		
    </body>
</html>