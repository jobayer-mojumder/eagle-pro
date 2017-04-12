<?php
    session_start();
    include_once('db_connect.php');
    include_once('model/CreateTable.php');
    $objOne=new CreateTable();
    $objOne->createCompanyTable();
    $objOne->createUserTable();
    $objOne->createOrderTable();
    $objOne->createPostTable();
    $objOne->createMonitoringTable();
    $objOne->createServiceTable();
    $objOne->createTargetTable();
    $objOne->createAchieveTable();
    
    $err=1;
    $objOne->createMonitoringTable();

//Table create end.


    $err=0;
    include_once('controller/FetchValue.php');
    if(isset($_POST['login'])) {
        $username = $_POST['username']; #echo $username;
        $password = $_POST['password']; #echo $password.'<br>';
        $password = md5($password);
        $loginObj = new FetchValue();
        $loginStatus=$loginObj->LoginCheck($username,$password);
        echo$loginStatus;
        if($loginStatus){
            $err=0;
            echo'Ok';
            //header('Location: '.'index.php');

        }else{
            $err=1;
        }
    }


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Page</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<style>
    body{
        background-color: #01a0e4;
    }
</style>
</head>

<body>
	<!--<img class="center-block" src="img/logo.png" alt="" width="300" height="160"><br>-->
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading text-center">Log in</div>
				<div class="panel-body">
					<form role="form" method="POST">
						<fieldset>
                            <?php
                                if($err!=0){
                                    echo ' <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              Username or Password Wrong
                        </div>';
                                }
                            ?>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail Or Username" id="username" name="username" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<button class="btn btn-primary btn-block" type="submit" name="login">Login</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>

</body>
</html>
