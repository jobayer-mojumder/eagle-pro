<?php
session_start();
include('header.php');
$user_check = $_SESSION['user_type'];
?>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <li class="active"><a href="index.php">
                <svg class="glyph stroked dashboard-dial">
                    <use xlink:href="#stroked-dashboard-dial"></use>
                </svg>
                Dashboard</a></li>
        <?php
        if ($user_check == 'super_admin') {
            echo ' <li><a href="?page=company"><i class="fa fa-building-o" aria-hidden="true"></i> Add Company</a></li>';
        } else {


            ?>

            <?php
            if ($_SESSION['user_type'] == "admin" || $_SESSION['user_type'] == "super_admin" || $_SESSION['user_type'] == "head") {
                ?>
                <li><a href="?page=emp"><i class="fa fa-users" aria-hidden="true"></i> Employees</a></li>
                <li><a href="?page=assign_post"><i class="fa fa-users" aria-hidden="true"></i> Create And Assign
                        Post</a></li>
						<li><a href="?page=target"><i class="fa fa-bullseye" aria-hidden="true"></i> Assign Target</a></li>
                <li><a href="?page=tree"><i class="fa fa-bullseye" aria-hidden="true"></i>Tree View</a></li>

                <li><a href="?page=products"><i class="fa fa-product-hunt" aria-hidden="true"></i> Products</a></li>

                <li><a href="?page=view_order"><i class="fa fa-bullseye" aria-hidden="true"></i> View Order</a></li>

                <li><a href="?page=real_time"><i class="fa fa-eye" aria-hidden="true"></i> Real Time Monitoring</a></li>
                <li><a href="?page=notice"><i class="fa fa-question-circle" aria-hidden="true"></i></i> Notice</a></li>
                <li><a href="?page=attendance"><i class="fa fa-question-circle" aria-hidden="true"></i></i> Attendance</a></li>
                 <li><a href="?page=best_employee"><i class="fa fa-question-circle" aria-hidden="true"></i></i> Best Employee</a></li>
           
            <?php
            }
            else if ($_SESSION['user_type'] == 'head') {
                ?>
                <li><a href="?page=target"><i class="fa fa-bullseye" aria-hidden="true"></i> Assign Target</a></li>

                <li><a href="?page=tree"><i class="fa fa-bullseye" aria-hidden="true"></i>Tree View</a></li>

                <li><a href="?page=products"><i class="fa fa-product-hunt" aria-hidden="true"></i> Products</a></li>

                <li><a href="?page=view_order"><i class="fa fa-bullseye" aria-hidden="true"></i> View Order</a></li>

                <li><a href="?page=real_time"><i class="fa fa-eye" aria-hidden="true"></i> Real Time Monitoring</a></li>
                <li><a href="?page=notice"><i class="fa fa-question-circle" aria-hidden="true"></i></i> Notice</a></li>
           
            <?php
            }
            else  if ($_SESSION['user_type'] == "sales_officer"){
                echo '
                    <li><a href="?page=add_order"><i class="fa fa-bullseye" aria-hidden="true"></i> Add order</a></li>
                    <li><a href="?page=mytarget"><i class="fa fa-bullseye" aria-hidden="true"></i>My Target</a></li>
                    <li><a href="?page=notice"><i class="fa fa-question-circle" aria-hidden="true"></i></i> Notice</a></li>
                    ';
                }
                else
               {
                    echo '<li><a href="?page=mytarget"><i class="fa fa-bullseye" aria-hidden="true"></i>My Target</a></li>
                    <li><a href="?page=target"><i class="fa fa-bullseye" aria-hidden="true"></i> Target</a></li>
                    <li><a href="?page=tree"><i class="fa fa-bullseye" aria-hidden="true"></i>Tree View</a></li>
                    <li><a href="?page=notice"><i class="fa fa-question-circle" aria-hidden="true"></i></i> Notice</a></li>'; 
               }
            
            ?>
        <?php
        }?>
    </ul>

</div><!--/.sidebar-->


<?php
    $usercheck = $_SESSION['username'];
    $password = $_SESSION['password'];

    if (!$usercheck && !$password) {
        header('Location: login.php');

    }

    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'emp') {
            include('views/employee.php');
        } else if ($_GET['page'] == 'company') {
            include('add_company.php');
        } else if ($_GET['page'] == 'outlet') {
            include('Views/outlet_view/outlet.php');
        } else if ($_GET['page'] == 'products') {
            include('products.php');
        } else if ($_GET['page'] == 'assign_post') {
            include('views/assign_post.php');
        } else if ($_GET['page'] == 'view_order') {
            include('view_order.php');
        } else if ($_GET['page'] == 'target') {
            include('target.php');
        } else if ($_GET['page'] == 'tree') {
            include('tree_view.php');
        } else if ($_GET['page'] == 'target') {
            include('target.php');
        } else if ($_GET['page'] == 'daily') {
            include('daily_report.php');
        } else if ($_GET['page'] == 'real_time') {
            include('track_all_user.php');
        } else if ($_GET['page'] == 'query') {
            include('query.php');
        } else if ($_GET['page'] == 'notice') {
            include('notice.php');
        } else if ($_GET['page'] == 'attendance') {
            include('views/attendance.php');
        } else if ($_GET['page'] == 'add_order') {
            include('add_order.php');
        }else if ($_GET['page'] == 'mytarget') {
            include('mytarget.php');
        }else if($_GET['page'] == 'best_employee'){
            include('best_employee.php');
        }else if($_GET['page'] == 'setting'){
            include('views/setting.php');
        }
         else {
            //header('Location: login.php');
        }

    } else {
        include('admin_content.php');

    }


    include('footer.php');
    $conn = null;

?>
