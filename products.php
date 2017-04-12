<?php
    	include('db_connect.php');
    // sql to create table
    $company_id= $_SESSION['cmp_id'];
    $msg = 2;
    if (isset($_POST['save'])) {
        //echo $outlet_id.'<br>';
        $service_name = $_POST['service_name'].' ('.$_POST['service_type'].')'; //echo $shop_name;
        $service_price = $_POST['service_price']; //echo $phone;
        $status = 1 ; //echo $status;


        try {
            $stmt = $conn->prepare("INSERT INTO service_table (service_name, service_price, status)
                VALUES (:service_name, :service_price, :status) ");
            $stmt->bindParam(':service_name', $service_name);
            $stmt->bindParam(':service_price', $service_price);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
            $msg = 1;
        } catch (Exception $e) {
            //echo $e->getMessage();
            $msg = 5;
        }


    }
	if (isset($_POST['edit'])) {
        //echo $outlet_id.'<br>';
        $id = $_POST['thisId']; //echo $shop_name;
        $service_name = $_POST['service_name'].' ('.$_POST['service_type'].')';;
        $service_price = $_POST['service_price']; //echo $phone;
        $status = 1 ; //echo $status;


        try {
				$stmt=$conn->prepare("UPDATE service_table SET service_name='$service_name', service_price='$service_price' WHERE service_id=$id");
            $stmt->execute();
            $msg = 7;
        } catch (Exception $e) {
            //echo $e->getMessage();
            $msg = 5;
        }


    }
	
	if (isset($_POST['yes'])){
        $del = $_POST['del'];
        $stmt = $conn->prepare("DELETE FROM service_table WHERE service_id = $del");
        $stmt->execute();
    }
	

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            Service Information
        </ol>
    </div>
    <!--/.row-->
    <br>

    <div class="row">
        <div class="col-lg-5">
            <div class="panel panel-default">
                <div class="panel-heading">Service Entry</div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <?php if ($msg == 1) {
                            echo ' <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Products Added Successfully.
                        </div>';
                        }else if ($msg == 5) {
                            echo ' <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Product Id already Exist.
                        </div>';
                        }else if ($msg == 7) {
                            echo ' <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Product Updated.
                        </div>';
                        }?>

                        <div class="form-group">
                            <label for="service_name">Service Name</label>
                            <input id="service_name" class="form-control" type="text" placeholder="" name="service_name" required="true">
                        </div>

                        <div class="form-group">
                            <label for="category">Service Location</label>
                            <select class="form-control" name="service_type">
                                <option value=''>Select</option>
                                <option value='Dhaka City'>Dhaka City</option>
                                <option value='Nearby Dhaka'>Nearby Dhaka</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="service_name">Service Price</label>
                            <input id="service_name" class="form-control" type="text" placeholder="" name="service_price" required="true">
                        </div>

                        <button type="submit" name='save' class="btn btn-primary btn-block">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $stmt = $conn->prepare("SELECT * FROM service_table ORDER BY service_id DESC");
        $stmt->execute();
		$rowNo=$stmt->rowCount();
        $result = $stmt->fetchall();
        $count = 0;
        ?>
        <div class="col-lg-7">

            <div class="panel panel-default">
                <div class="panel-heading">Product View</div>
                <div class="panel-body">
                    <table class="table table-bordered table-responsive">
                        <thead>
                        
                        <?php
						if($rowNo<1){
							emptyList();
						}else{
							echo'<tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Price</th>
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
                                <td><?php echo $row['service_name']; ?></td>
                                <td><?php echo $row['service_price']; ?></td>
                                <td><button type="button" class="btn btn-primary btn-xs modal_edit" data-toggle="modal" data-target="#edit_modal"id="<?php echo $row['service_id'] ?>" onclick="editFunction(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                <td><button type="button" class="btn btn-danger btn-xs modal_delete" data-toggle="modal" data-target="#delete_modal" id="<?php echo $row['service_id'] ?>" onclick="deleteFunction(this.id)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></td>

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

<div class="modal fade" id="edit_modal" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id = "modal_target_title">Edit Product</h4>
                    </div>
                    
                    
                <div class="modal-body">
                    <form role="form" method="post" action="">
                        
                        <input type="text" style="display:none" name="thisId" id="edit">
                        
                        <div class="form-group">
                            <label for="modal_service_name">Service Name</label>
                            <input id="modal_service_name" class="form-control" type="text" placeholder="" name="service_name" value = " dsds" required="true">
                        </div>

                        <div class="form-group">
                            <label for="category">Service Location</label>
                             <select id = "modal_service_area" class="form-control" name="service_type">
                                <option value=''>Select</option>
                                <option value='Dhaka City'>Dhaka City</option>
                                <option value='nearby Dhaka'>Nearby Dhaka</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="modal_service_price">Service Price</label>
                            <input id="modal_service_price" class="form-control" type="number" placeholder="" name="service_price" required="true">
                        </div>

                        <button type="submit" name='edit' class="btn btn-primary btn-block">Save</button>
                    </form>
                </div>                  
                    
             </div>
     </div>
</div>


<script>   
function editFunction(id){
    document.getElementById('edit').value = id;
    

}
</script>



<div class="modal fade" id="delete_modal" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id = "modal_target_title">Delete Product</h4>
                    </div>   
                    <div class="modal-body">
						<h4>Do You want to delete this product?</h4>
                    </div>  
					<div class="modal-footer">
						<form role="form" method="post" action="">
						<input type="text" name="del" id="del" style="display: none" >
							<div class="col-sm-6"><button type="submit" name='yes' class="btn btn-danger btn-block ">Yes</button></div>
							<div class="col-sm-6"><button type="submit" name='no' class="btn btn-primary btn-block" data-dismiss="modal">No</button></div>
						</form>	
</div>						
                    
             </div>
     </div>
</div>

<script>
function deleteFunction(id){
    document.getElementById('del').value = id;
}
</script>




<?php
	function emptyList(){
		echo' <div class="panel-body">
			<p class="text-danger">List is empty</p>
		</div>';
	}
?>

<script>
 $(document).ready(function(){
        $('.modal_edit').on("click", function(){
           $('#modal_service_name').val($(this).parent().parent().find('td').eq(1).html().split(" (")[0]);
           $("#modal_service_area").val($(this).parent().parent().find('td').eq(1).html().split("(")[1].split(")")[0]);
           $('#modal_service_price').val($(this).parent().parent().find('td').eq(2).html());     
        });
    });
    
  </script>  
    


