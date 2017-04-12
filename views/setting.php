<?php
    	include('db_connect.php');
    // sql to create table
    $company_id= $_SESSION['cmp_id'];
    $user_id= $_SESSION['user_id'];
	
	try {

            $stmt = $conn->prepare("SELECT * FROM user_table WHERE user_id = '$user_id' LIMIT 1");
            $stmt->execute();
            $result = $stmt->fetchall();
			
        } catch (Exception $e) {
            return "error";
        }
	
    $msg = 2;
    
    if (isset($_POST['save'])) {
		try{
			
			$fname = $_POST['fname'];//echo$email;
			$password = $_POST['password'];//echo$password;
			$phone = $_POST['phone'];//echo $phone;
			$dateofbirth = $_POST['dateofbirth'];//echo $address;
			$blood_group = $_POST['blood_group'];//echo $address;
			$username = $_POST['username'];//echo $address;
			//$user_type = 'admin';
			$password = md5($password);
			$sql="UPDATE user_table SET username='$username',password='$password',full_name='$fname',
			dateofbirth='$dateofbirth',blood_group='$blood_group',phone='$phone'
			WHERE user_id=$user_id";
			$conn->exec($sql);
			$msg=1;
		}catch(Exception $e){
			echo$e->getMessage();
			$msg=5;
		}
        

    }

	

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            Edit Profile
        </ol>
    </div>
    <!--/.row-->
    <br>

    <div class="row">
        <div class="col-lg-6 col-sm-offset-3">
            <div class="panel panel-default">
                
                <div class="panel-body">
                    <form role="form" method="post" action="" enctype="multipart/form-data">
                        <?php if ($msg == 1) {
                            echo ' <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Profile Updated.
                        </div>';
                        }else if($msg==5){
                            echo ' <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               There was a problem.
                        </div>';
                        }?>
						<?php
							foreach($result as $res){
								
							
						?>
						
                        <div class="form-group">
                            <label>Full Name</label>
							
                            <input class="form-control" value="<?php echo$res['full_name'];?>"type="text" placeholder="" name="fname"
                                   required="true">
                        </div>
                        <div class="form-group">
                            <label>Date Of Birth Day</label>
                            <input class="form-control" value="<?php echo$res['dateofbirth'];?>" type="date" placeholder="" name="dateofbirth"
                                  >
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" value="<?php echo$res['phone'];?>" type="number" placeholder="" name="phone" required="true">
                        </div>
                        <div class="form-group">
                            <input type="file" name="fileupload" id="fileupload">
                        </div>

                        <div class="form-group">
                            <label>Blood Group</label>
                            <select class="form-control" name="blood_group">
                                <option value="blood_group">Blood Group</option>
                                <option>A+</option>
                                <option>A-</option>
                                <option selected>B+</option>
                                <option>B-</option>
                                <option>AB+</option>
                                <option>AB-</option>
                                <option>O+</option>
                                <option>O-</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" value="<?php echo$res['username'];?>"class="form-control" name="username" required="true">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input value = "<?php echo$res['password'];?>" type="password" class="form-control" name="password" required="true">
                        </div>
                        <button type="submit" name='save' class="btn btn-primary btn-block">Save</button>
                    </form>
						<?php } ?>	
                </div>
        </div>
    </div>
</div>
       
<script>   
function editFunction(id){
    document.getElementById('edit').value = id;
    

}
</script>



<?php
	function emptyList(){
		echo' <div class="panel-body">
			<p class="text-danger">List is empty</p>
		</div>';
	}
?>


    


