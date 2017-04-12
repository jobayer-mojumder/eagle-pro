<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <?php
    include_once('db_connect.php');
    include_once('model/DataInsertion.php');
    $msg = 2;
    
    $obj = new DataInsertion();

    if (isset($_POST['save'])) {
        $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");        
        
        $salesman_id = $_SESSION['user_id'];
        $customer_name = $_POST['customer_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $nid = $_POST['nid'];
        $pickup_date = $_POST['pickup_date'];
        $pickup_location = $_POST['pickup_location'];
        $service_type = $_POST['service_type'];
        $drop_off_date = $_POST['drop_off_date'];
        $drop_off_location = $_POST['drop_off_location'];
        $service_price = $_POST['service_price'];
        $temp = explode('-', $pickup_date);        
        $month = $months[$temp[1] - 1];        
        $year = $temp[0]; 
        $status = 0 ;
        
        //genereted data
        $lat = 0 ;
        $long = 0 ;
        $order_placed_at = 0 ;
        
        $msg = $obj->addOrder($salesman_id, $customer_name, $phone, $address, $nid, $pickup_date, $pickup_location, 
                $service_type, $drop_off_date, $drop_off_location, $service_price, $month, $year, $lat, $long, $order_placed_at, $status);



    }

    ?>


 <div class="row">
        <ol class="breadcrumb">
            Order Information
        </ol>
    </div>
    <!--/.row-->
    <br>

    <div class="row">
        <div class="col-lg-5">
            <div class="panel panel-default">
                <div class="panel-heading">Add Order</div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <?php if ($msg == 1) {
                            echo ' <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Order Added Successfully.
                        </div>';
                        }else if ($msg == 5) {
                            echo ' <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Product Id already Exist.
                        </div>';
                        }?>

                        <div class="form-group">
                            <label for="customer_name">Customer Name</label>
                            <input id="customer_name" class="form-control" type="text" placeholder="" name="customer_name" required="true">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input id="phone" class="form-control" type="text" placeholder="" name="phone" required="true">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input id="address" class="form-control" type="text" placeholder="" name="address" required="true">
                        </div>

                        <div class="form-group">
                            <label for="nid">NID</label>
                            <input id="nid" class="form-control" type="text" placeholder="" name="nid" required="true">
                        </div>

                        <div class="form-group">
                            <label for="pickup_date">Pickup Date</label>
                            <input id="pickup_date" class="form-control" type="DATE" placeholder="" name="pickup_date" required="true">
                        </div>
                        
                        <div class="form-group">
                            <label for="pickup_location">Pickup Location</label>
                            <input id="pickup_location" class="form-control" type="text" placeholder="" name="pickup_location" required="true">
                        </div>

                        <div class="form-group">
                            <label for="service_type">Service Type</label>

                           <select class="form-control" name="service_type" id = "service_type">
                                <?php include('all_service.php'); ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="drop_off_date">Drop Off Date</label>
                            <input id="drop_off_date" class="form-control" type="DATE" placeholder="" name="drop_off_date" required="true">
                        </div>

                        <div class="form-group">
                            <label for="drop_off_date">Drop Off Location</label>
                            <input id="drop_off_location" class="form-control" type="text" placeholder="" name="drop_off_location" required="true">
                        </div>

                        <div class="form-group">
                            <label for="service_price">Service Price</label>
                            <input id="service_price" class="form-control" type="text" placeholder="" name="service_price" required="true">
                        </div>

                        <button type="submit" name='save' class="btn btn-primary btn-block">Save</button>
                    </form>
                </div>
            </div>
        </div>

<?php
    $post_id = $_SESSION["user_id"];    
    include_once('controller/FetchValue.php');
    $obj2 = new FetchValue();
    $result = $obj2->salesmanOrderView($post_id);
        
?>

        <div class="col-lg-7">
            <div class="panel panel-default">
                <div class="panel-heading">My Order</div>
                <div class="panel-body">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Order Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
               <?php
               $count = 1;
               foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $count++ ?></td>
                    <td><?php echo $row['customer_name'] ?></td>
                    <td><?php echo $row['phone'] ?></td>
                    <td><?php echo $row['service_name'] ?></td>
                    <?php if($row['status']==0){
                        echo '<td>Pending</td>';
                    }
                    else if($row['status']==1){
                        echo '<td>Accepted</td>';
                    }
                    else{
                        echo '<td>Rejected</td>';
                    }
                    ?>
                </tr>
                
                <?php   } ?>
                
                </tbody>
                </table>
                </div>
            </div>
        </div>
</div>
<script>



$( document ).ready(function() {
    $( "#service_type" ).on( "change", function() {
        var value = $(this).val();
        assign_price(value);
    });
    
    function assign_price(value)
        {

            $.ajax({
                url:"service_price.php",
                data:{service_id:value},
                dataType:"text",
                method:"POST",
                success:function(data){
                    $('#service_price').val(data);
                    if (data != 0)
                        $('#service_price').prop("readonly",true);
                    else
                        $('#service_price').prop("readonly",false);
                }
            });
        }
        
    
    function confirmationDelete(anchor)
    {
       var conf = confirm('Are you sure want to delete this record?');
       if(conf)
          window.location=anchor.attr("href");
    }

});

</script>
<?php
    function emptyList(){
        echo' <div class="panel-body">
            <p class="text-danger">List is empty</p>
        </div>';
    }
?>
