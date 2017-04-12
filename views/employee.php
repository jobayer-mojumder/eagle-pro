<?php
    include('usercheck.php');
    include('model/EmployeeDetails.php');
    include('model/CreateTable.php');
    $company_id= $_SESSION['cmp_id'];
    $msg = 2;
    $sql = null;
    $createUsersTable=new CreateTable();
    $createUsersTable->createUserTable();
    $user=new EmployeeDetails();
    if (isset($_POST['save'])) {
        $fullname = $_POST['fname'];//echo$fullname;
        $phone = $_POST['phone'];//echo$phone;
        $designation = $_POST['designation'];//echo$username;
        $username = $_POST['username'];//echo$fullname;
        $password = $_POST['password'];//echo$password;
        $password = md5($password);
        $dateofbirth = $_POST['dateofbirth'];//echo$password;
        $blood_group = $_POST['blood_group'];//echo$password;
        $user_type = $designation;
        $target_dir = "salesman_pic/";
        $targetFile=$target_dir.basename($_FILES['fileupload']['name']);
        $fileType=pathinfo($targetFile,PATHINFO_EXTENSION);
        $newfilename="salesman_pic/". $username.".".$fileType;
        $msg=$user->employeeRegistration($fullname,$phone,$designation,$username,$password,$dateofbirth,$blood_group,$user_type,$company_id,$newfilename);
    }

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            Employee
        </ol>
    </div>
    <!--/.row-->
    <br>

    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">Employee Add</div>
                <div class="panel-body">
                    <form role="form" method="post" action="" enctype="multipart/form-data">
                        <?php if ($msg == 1) {
                            echo ' <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Employee Added Successfully.
                        </div>';
                        }else if($msg==5){
                            echo ' <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Username Already Exist
                        </div>';
                        }?>


                        <div class="form-group">
                            <label>Full Name</label>
                            <input class="form-control" value=""type="text" placeholder="" name="fname"
                                   required="true">
                        </div>
                        <div class="form-group">
                            <label>Date Of Birth Day</label>
                            <input class="form-control" value="" type="date" placeholder="" name="dateofbirth"
                                  >
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" value="" type="number" placeholder="" name="phone" required="true">
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <?php include('views/helper/designations.php');?>
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
                            <input type="text" class="form-control" name="username" required="true">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input value = "" type="password" class="form-control" name="password" required="true">
                        </div>
                        <button type="submit" name='save' class="btn btn-primary btn-block">Save</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">Employee View</div>
                <div class="panel-body">
                    <!--Search Code-->
                    <div class="row">
                        <div class="col-sm-6">
                            <form class="form-inline" method="POST">
                                <div class="form-group">

                                    <?php include('views/helper/designations.php');?>

                                </div>
                                <button type="submit" class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search" ></span></button>
                            </form>
                        </div>

                        <div class="col-sm-6 pull-left">

                        </div>
                    </div><br>

                    <!--Search End-->
                    <?php
                        if(isset($_POST['search'])){
                            $designation = $_POST['designation'];//echo$username;
                            $result=$user->viewDetails($company_id,$designation);
                            $temp=count($result);
                            if($temp>=1) $rowNo=1;
                            else $rowNo=0;
                        }else{
                            $result=$user->viewDetailsAll($company_id);
                            $temp=count($result);
                            if($temp>=1) $rowNo=1;
                            else $rowNo=0;
                        }
                        $count = 0;
                    ?>
                    <table class="table table-bordered table-responsive">
                        
                        <?php
							if($rowNo<1){
								emptyList();
							}else{
								echo'<thead>
							<tr>
                                <th style="display: none;">username</th>
								<th>SL</th>
								<th>Full Name</th>
								<th>Designation</th>
								<th>Phone</th>
								<th>Username</th>
								<th>DOB</th>
								<th>BG</th>
								<th>Photo</th>
								
								<th>Edit</th>
								<th>Delete</th>
							</tr>
                        </thead>
                        <tbody>';
							}
								foreach ($result as $row) {
								$count++;
                            ?>

                            <tr>
                                <td><?php echo $count ?></td>
                                <td id="e_fname<?php echo $row['user_id'];?>" ><?php echo $row['full_name']; ?></td>
                                <td id="e_designation<?php echo $row['user_id'];?>"><?php echo $row['designation']; ?></td>
                                <td id="e_phone<?php echo $row['user_id'];?>"><?php echo $row['phone']; ?></td>
                                <td id="e_username<?php echo $row['user_id'];?>"><?php echo $row['username']; ?></td>
                                <td id="e_dateofbirth<?php echo $row['user_id'];?>"><?php echo $row['dateofbirth']; ?></td>
                                <td id="e_blood_group<?php echo $row['user_id'];?>"><?php echo $row['blood_group']; ?></td>
                                <td ><img src="<?php echo $row['imageref']; ?>" height="30px" width="30px"></td>
                                
                                <td> <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal" id="<?php echo $row['user_id'] ?>" onclick="edit(this.id);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                 <td><a onclick='javascript:confirmationDelete($(this));return false; 'href="delete.php?id=<?php echo $row['user_id'];?>&& table_name=user_table" type="button" class="btn btn-danger btn-xs">
								<i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>


                            </tr>



                        <?php
                        }


                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->

</div>

<script>
    function confirmationDelete(anchor)
    {
       var conf = confirm('Are you sure want to delete this record?');
       if(conf)
          window.location=anchor.attr("href");
    }
</script>

<?php
	function emptyList(){
		echo' <div class="panel-body">
			<p class="text-danger">List is empty</p>
		</div>';
	}
?>

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Employee</h4>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="" enctype="multipart/form-data">
                <?php if ($msg == 1) {
                            echo ' <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Employee Added Successfully.
                        </div>';
                        }else if($msg==5){
                            echo ' <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Username Already Exist
                        </div>';
                        }?>

                        <input type="text" name="id_field" id="id_field">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input class="form-control" value=""type="text" placeholder="" name="e_fname" id="e_fname" 
                                   required="true">
                        </div>
                        <div class="form-group">
                            <label>Date Of Birth Day</label>
                            <input class="form-control" value="" type="date" placeholder="" name="e_dateofbirth" id="e_dateofbirth" 
                                  >
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" value="" type="number" placeholder="" name="e_phone" id="e_phone" required="true">
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <?php include('views/helper/designations.php');?>
                        </div>
                        <div class="form-group">
                            <input type="file" name="fileupload" id="fileupload">
                        </div>

                        <div class="form-group">
                            <label>Blood Group</label>
                            <select class="form-control" name="e_blood_group" id="e_blood_group">
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
                            <input type="text" class="form-control" name="e_username" id="e_username" required="true">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input value = "1234" type="password" class="form-control" name="e_password" id="e_password" required="true">
                        </div>
            <button type="submit" name='edit' class="btn btn-primary btn-block">Save</button>
        </div>

      </div>
      
    </div>
  </div>
<script>
    function edit(id){
        var id=id;
        document.getElementById('id_field').value = id;
        document.getElementById('e_fname').value = document.getElementById('e_fname'+id).innerHTML;
        document.getElementById('e_username').value = document.getElementById('e_username'+id).innerHTML;
        document.getElementById('e_phone').value = document.getElementById('e_phone'+id).innerHTML;
        document.getElementById('e_dateofbirth').value = document.getElementById('e_dateofbirth'+id).innerHTML;
        document.getElementById('e_blood_group').value = document.getElementById('e_blood_group'+id).innerHTML;
    }

</script>


<?php
    if(isset($_POST['edit'])){
        $fullname = $_POST['e_fname'];//echo$fullname;
        $phone = $_POST['e_phone'];//echo$phone;
        $designation = 'head';//echo$username;
        $username = $_POST['e_username'];//echo$fullname;
        $password = $_POST['e_password'];//echo$password;
        $password = md5($_POST['e_password']);
        $dateofbirth = $_POST['e_dateofbirth'];//echo$password;
        $blood_group = $_POST['e_blood_group'];//echo$password;
        $id = $_POST['id_field'];

        $target_dir = "salesman_pic/";
        $targetFile=$target_dir.basename($_FILES['fileupload']['name']);
        $fileType=pathinfo($targetFile,PATHINFO_EXTENSION);
        $newfilename="salesman_pic/". $username.".".$fileType;

        $msg=$user->employeeEdit($fullname,$phone,$designation,$username,$password,$dateofbirth,$blood_group,$newfilename,$id);
        echo $msg;
    }
?>