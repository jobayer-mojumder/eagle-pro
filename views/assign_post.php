<script>
    $(document).ready(function(){
        $('#selected_post').change(function(){
            var boss = $(this).val();
            fetch_data(boss);
            assign_person_options($(this).val())
        });

        $('#person_assign').hide();

        $('#btn_assign_person').click(function(){
            assign_person_options($('#selected_post').val());
            $('#person_assign').show();
        });


        function assign_person_options(post_title)
        {

            $.ajax({
                url:"views/helper/assign_person.php",
                data:{post_title:post_title},
                dataType:"text",
                method:"POST",
                success:function(data){
                    $('#person_assign').html(data);
                }
            });
        }



        function fetch_data(boss)
        {

            $.ajax({
                url:"views/helper/select_immediate_boss.php",
                data:{boss:boss},
                dataType:"text",
                method:"POST",
                success:function(data){
                    $('#upper').html(data);
                }
            });
        }



        $('.remove_assignment a').click(function(){
            var sure = confirm("Are you sure?");
            if (sure)
            {
                var x = $(this).attr('id').split(' ');

                $.ajax({
                    url:"views/helper/delete_assignment.php",
                    data: {post_id: x[0], user_id: x[1]},
                    dataType:"text",
                    method:"POST",
                    success:function(data){
                        location.reload();
                    }
                });
            }
        });


        $('.table tbody tr td.assign_person a').click( function () {
            $('#modal_post_title').text($(this).parent().parent().find('td:nth-child(2)').text());
            $('#modal_post_id').text($(this).attr('id'));

            $.ajax({
                url:"views/helper/assign_person.php",
                data:{post_title:$(this).parent().parent().find('td:nth-child(2)').text()},
                dataType:"text",
                method:"POST",
                success:function(data){
                    $('#modal_person_assign').html(data);
                }
            });

            $('#assign_post_modal').modal('show');
        });


        $('#modal_submit').click(function()
        {
            if ($("#modal_person_assign option:selected" ).val() != 0)
            {
                $.ajax({
                    url:"views/helper/insert_assignment.php",
                    data:{post_id: $("#modal_post_id").text() , user_id:$("#modal_person_assign option:selected" ).val()},
                    dataType:"text",
                    method:"POST",
                    success:function(data){
                        alert(data);
                        $('#assign_post_modal').modal('hide');
                        location.reload();
                    }
                });
            }

        });


    });
</script>


<?php
include('usercheck.php');
include('model/EmployeeDetails.php');
include('model/CreateTable.php');
include('db_connect.php');
$company_id= $_SESSION['cmp_id'];
$msg = 2;
$sql = null;
$createUsersTable=new CreateTable();
$createUsersTable->createUserTable();
$user=new EmployeeDetails();

if ($_POST['post_title'] == 'head')
{
    $_POST['boss_id'] = 0;
}

if ((isset($_POST['save']) && $_POST['boss_id'] != "") || (isset($_POST['save']) && $_POST['post_title'] == "head")) {

    $msg = 1;
    $post_title = $_POST['post_title'];
    
    if ($_POST['post_title'] == "head")
    {
        $boss_id = 0;
    }
    else
    {
        $boss_id = $_POST['boss_id'];
    }
    
    $area = $_POST['area'];
    $user_id = $_POST['user_id'];
	$insertDate=date('Y');
    $stmt = $conn->prepare("INSERT INTO post_table (post_title, boss_id, area, year)
                    VALUES (:post_title, :boss_id, :area, :year)");
    $stmt->bindParam(':post_title', $post_title);
    $stmt->bindParam(':boss_id', $boss_id);
    $stmt->bindParam(':area', $area);
    $stmt->bindParam(':year', $insertDate);
    $stmt->execute();

    $post_id = $conn->lastInsertId();

    if ($post_id)
    {
        if ($user_id != 0)
        {

            $stmt = $conn->prepare("UPDATE user_table SET assigned_status=1 WHERE user_id='$user_id'");
            if ($stmt->execute())
            {
                $stmt = $conn->prepare("UPDATE post_table SET status=1, user_id =  :user_id WHERE post_id='$post_id'");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
            }
        }
    }    
}
else if (isset($_POST['save']) && $_POST['boss_id'] == "")
    {
        $msg = 5;
    } 
    
else
    {
        $msg = 9;
    }   

?>
<div class="modal" id="assign_post_modal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id = "modal_post_title">A</h4>
            </div>


            <div class="modal-body">
                <h5 id = "modal_post_id" hidden = "true"></h5>
                <select id = "modal_person_assign" class="form-control" name="user_id">

                </select>
            </div>
            <br><br><br>

            <div class="modal-footer">
                <button id = "modal_submit" type="button" class="btn btn-primary btn-block">Submit</button>
            </div>

        </div>
    </div>
</div>



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
                <div class="panel-heading">Create And Assign Post</div>
                
                <?php if ($msg == 1) {
                            echo ' <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Post Created Successfully
                        </div>';
                        }else if ($msg == 5) {
                            echo ' <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Select Boss Properly
                        </div>';
                        }?>
                <div class="panel-body">
                    <form role="form" method="post" action="">


                        <div class="form-group">
                            <label>Post Title</label>
                            <select id = "selected_post" class="form-control" name="post_title">
                                <option value="head">Head</option>
                                <option value="manager">Manager</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="sales_officer">Sales Officer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Immediate Boss</label>
                            <select id = "upper" class="form-control" name="boss_id">
                                //php generated
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Area</label>
                            <input class="form-control" value=""type="text" placeholder="" name="area">
                        </div>



                        <div class="form-group" id = "assign_person">
                            <button type = "button" id = "btn_assign_person">Assign Person</button>
                            <select id = "person_assign" class="form-control" name="user_id">
                                //php generated
                            </select>
                        </div>




                        <button type="submit" name='save' class="btn btn-primary btn-block">Save</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">

            <div class="panel panel-default">
                <div class="panel-heading">Post View</div>
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
                    if(isset($_POST['search']) || true){

                        if (isset($_POST['search']))
                        {
                        $post_title = $_POST['designation'];

                        // Fixed the search box
                        echo '<script>$("#designation").val("'. $post_title .'");</script>';

                        $stmt = $conn->prepare("select post_table.post_id, post_table.area, post_table.post_title,  post_table.boss_id, post_table.status, post_table.user_id, user_table.user_id, user_table.full_name from post_table
                            left join user_table on post_table.user_id= user_table.user_id
                            where post_title = :post_title");
                        $stmt->bindParam(':post_title', $post_title);
                    }
                    else
                    {
                        $stmt = $conn->prepare("select post_table.post_id, post_table.area, post_table.post_title,  post_table.boss_id, post_table.status, post_table.user_id, user_table.user_id, user_table.full_name from post_table
                            left join user_table on post_table.user_id= user_table.user_id
                            ");
                    }

                        $stmt->execute();
                        $result = $stmt->fetchall();
                        $count = 0;
                        $temp=count($result);
                        if($temp == 0) {
                            $rowNo=1;
                            emptyList();
                        }
                        else{
                            ?>
                            <table class="table table-bordered table-responsive">
                            <thead>
                                <th>SL</th>
                                <th>Post Title</th>
                                <th>Full name</th>
                                <th>Area</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($result as $row) {
                                $count++;
                                ?>
                                <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $row['post_title']; ?></td>
                                <td><?php echo $row['full_name']; ?></td>
                                <td><?php echo $row['area']; ?></td>
                                <?php
                                    if ($row['status'] != 1)
                                    {
                                        
                                        echo '<td class = "assign_person"><a id = "'. $row['post_id']. '" type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-plus-square" aria-hidden="true"></i> Assign</a></td>';
                                    }
                                    else
                                    {
                                    //echo '<script>alert("'.$row['post_id'] .'");</script>';
                                        echo '<td class = "remove_assignment"><a id = "'. $row['post_id']. ' '.$row['user_id']. '" type="button" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>';
                                    }
                                ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                            </table>
                        <?php
                        }
                    }
                    ?>

                <!--Isset End-->


<?php
function emptyList(){
    echo' <div class="panel-body">
            <p class="text-danger">List is empty</p>
        </div>';
}
?>
