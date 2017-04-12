<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <?php
    include('db_connect.php');
    // sql to create table
    $msg = 2;

    $sql = null;

    if (isset($_POST['save'])) {
        $company_name = $_POST['company_name']; //echo $company_name;
        $email = $_POST['email'];//echo$email;
        $password = $_POST['password'];//echo$password;
        $phone = $_POST['phone'];//echo $phone;
        $address = $_POST['address'];//echo $address;
        $user_type = 'admin';
        $password = md5($password);
        include_once('model/DataInsertion.php');
        $insertObj = new DataInsertion();
        $msg = $insertObj->addCompanyInfo($company_name, $email, $password, $phone, $address, $user_type);

    }

    ?>

    <div class="row">
        <ol class="breadcrumb">
            Company Information
        </ol>
    </div>
    <!--/.row-->
    <br>

    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">Company Add</div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <?php if ($msg == 1) {
                            echo ' <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Employee Added Successfully.
                        </div>';
                        } else if ($msg == 5) {
                            echo ' <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Email Address already Exist
                        </div>';
                        }?>

                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input id="company_name" class="form-control" type="company_name" placeholder=""
                                   name="company_name" required="true">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" type="email" placeholder="" name="email"
                                   required="true">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required="true">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="number" placeholder="" name="phone" required="true">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" placeholder="" name="address" required="true"></textarea>
                        </div>
                        <button type="submit" name='save' class="btn btn-primary btn-block">Save</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
            $stmt = $conn->prepare("SELECT * FROM company_table ORDER BY cmp_id");
            $stmt->execute();
            $result = $stmt->fetchall();
            $count = 0;
        ?>

        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">Company View</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Company Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($result as $row) {
                            $count++;
                            ?>

                            <tr>
                                <td ><?php echo $count ?></td>
                                <td id="e_cname<?php echo $row['cmp_id']; ?>" ><?php echo $row['company_name']; ?></td>
                                <td id="e_caddress<?php echo $row['cmp_id']; ?>"><?php echo $row['address']; ?></td>
                                <td id="e_cphone<?php echo $row['cmp_id']; ?>"><?php echo $row['phone']; ?></td>
                                <td id="e_cemail<?php echo $row['cmp_id']; ?>"><?php echo $row['username']; ?></td>
                                <td><a id=<?php echo $row['cmp_id']; ?>  type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" onclick="edit(this.id);">Edit</a></td>

                                <td><a href="delete.php?id=<?php echo $row['cmp_id']; ?>&& table_name=company_table"
                                       type="button" class="btn btn-danger btn-xs">Delete</a></td>

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

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
              <form role="form" method="post">
                        <input type="text" name="id_field" id="id_field">
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input id="edit_cname" class="form-control" type="company_name" placeholder=""
                                   name="edit_cname" required="true">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="edit_cemail" class="form-control" type="email" placeholder="" name="edit_cemail"
                                   required="true">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="edit_cpass" class="form-control" name="edit_cpass" required="true">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" id="edit_cphone" type="number" placeholder="" name="edit_cphone" required="true">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" placeholder="" name="edit_caddress" required="true" id="edit_caddress"></textarea>
                        </div>
                        <button type="submit" name='save1' class="btn btn-primary btn-block">Save</button>
                    </form>
                <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>


</div>

<script>
    function edit(id){
        var id=id;
        
        document.getElementById('id_field').value = id;
        
        document.getElementById('edit_cname').value=document.getElementById('e_cname'+id).innerHTML;
document.getElementById('edit_caddress').value=document.getElementById('e_caddress'+id).innerHTML;
       
       document.getElementById('edit_cphone').value=document.getElementById('e_cphone'+id).innerHTML;

        document.getElementById('edit_cemail').value=document.getElementById('e_cemail'+d).innerHTML;
    }
</script>

<?php
  if(isset($_POST['save1'])){
    $name = $_POST['edit_cname'];
    $address = $_POST['edit_caddress'];
    $phone = $_POST['edit_cphone'];
    $username = $_POST['edit_cemail'];
    $pass = md5($_POST['edit_cpass']);
    $id = $_POST['id_field'];
     try {
        $stmt = $conn->prepare("UPDATE company_table SET username= :username, password=:pass, company_name= :name, phone=:phone, address=:address WHERE cmp_id = :id");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':pass', $pass);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
?>