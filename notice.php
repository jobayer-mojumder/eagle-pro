<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <?php
    include('db_connect.php');
    // sql to create table
    $company_id= $_SESSION['cmp_id'];
    $msg = 2;
    $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $hh=$dt->format('Y-m-d h-i-s');
    echo$hh;


    try {
        $sql = "CREATE TABLE IF NOT EXISTS notice (
            nt_id INT AUTO_INCREMENT PRIMARY KEY,
            company_id INT,
            subject VARCHAR(255),
            detail_msg VARCHAR(255),
            status int,
            insert_time TIMESTAMP
            )";
        $conn->exec($sql);
        //print("Created  Table.\n");
    } catch (Exception $e) {
        //echo$e->getMessage();
    }

    $sql = null;

    if (isset($_POST['save'])) {
        $subject = $_POST['subject']; //echo $shop_name;
        $detail_msg = $_POST['detail_msg']; //echo $phone;
        $status = 1 ; //echo $status;


        try {
            $stmt = $conn->prepare("INSERT INTO notice(status, company_id , subject,detail_msg,insert_time)
                VALUES (:status, :company_id , :subject,:detail_msg,:times)  ");
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':company_id', $company_id);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':detail_msg', $detail_msg);
            $stmt->bindParam(':times', $hh);
            $stmt->execute();
            $msg = 1;
        } catch (Exception $e) {
            echo $e->getMessage();

        }


    }

    ?>

    <div class="row">
        <ol class="breadcrumb">
            Notice
        </ol>
    </div>
    <!--/.row-->
    <br>

    <div class="row">
        <div class="col-lg-5">
            <div class="panel panel-default">
                <div class="panel-heading">Notice</div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <?php if ($msg == 1) {
                            echo ' <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               Notice Added Successfully.
                        </div>';
                        }else if ($msg == 5) {
                            echo ' <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               There was a problem
                        </div>';
                        }?>

                        <div class="form-group">
                            <label for="product_id">Subject</label>
                            <input id="subject" class="form-control" type="text" placeholder="" name="subject" required="true">
                        </div>

                        <div class="form-group">
                            <label for="product_name">Message</label>
                            <textarea class="form-control" type="text" placeholder="" name="detail_msg" required="true"></textarea>
                        </div>

                        <button type="submit" name='save' class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
        </div>
        <?php
        $stmt = $conn->prepare("SELECT * FROM notice order by nt_id DESC");
        $stmt->execute();
        $rowNo=$stmt->rowCount();
        $result = $stmt->fetchall();
        $count = 0;
        ?>
        <div class="col-lg-7">

            <div class="panel panel-default">
                <div class="panel-heading">Notice View</div>
                <div class="panel-body">
                    <table class="table table-bordered table-responsive">
                        <thead>

                        <?php
                        if($rowNo<1){
                            emptyList();
                        }else{
                            echo'<tr>
                            <th>SL</th>
                            <th>Subject</th>
                            <th>Message</th>

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
                                <td><?php echo $row['subject']; ?></td>
                                <td><?php echo $row['detail_msg']; ?></td>
                                <td><a onclick='javascript:confirmationDelete($(this));return false; 'href="delete.php?id=<?php echo $row['id'];?>&& table_name=" type="button" class="btn btn-danger btn-xs">
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
