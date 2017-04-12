<script type="text/javascript">
window.onload = function () {
    
}
</script>


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Tree View</div>
                <div class="panel-body" style="padding-bottom: 5px;">
                    <div class="col-sm-12">
                        <div class="form-inline">
                        <?php if($_SESSION['user_type']=='head') {?>
                            <div class="form-group col-sm-3">
                                <label for="manager">Manager : </label>
                                <select class="form-control" id="select_manager" name="manager">
                                </select>
                            </div>
                            <?php }
                            if($_SESSION['user_type']=='manager' || $_SESSION['user_type']=='head') {?>
                            <div class="form-group col-sm-4">
                                <label for="supervisor">Supervisor :</label>
                                <select class="form-control" id="select_supervisor" name="supervisor">
                                    <option value=''>--Select Supervisor--</option>
                                    <option value="" >1</option>
                                    <option value="" >2</option>
                                </select>
                            </div>
                            <?php }
                            if($_SESSION['user_type']=='manager' || $_SESSION['user_type']=='head' || $_SESSION['user_type']=='supervisor') {?>
                            <div class="form-group col-sm-4">
                                <label for="sales_officer">Sales Officer :</label>
                                <select class="form-control" id="select_sales_officer" name="sales_officer">
                                    <option value=''>--Select Sales Officer--</option>
                                    <option value="" >1</option>
                                    <option value="" >2</option>
                                </select>
                            </div>
                            <?php } ?>
                            <button class="btn btn-primary" id="search"><span class="glyphicon glyphicon-search" ></span></button>
                            </br></br>
                            <div class="form-group col-sm-4">
                                <label for="month">Month :</label>
                                <select class="form-control" id="select_month" name="month">
                                    <option value='Jan'>January</option>
                                    <option value='Feb'>February</option>
                                    <option value='Mar'>March</option>
                                    <option value='Apr'>April</option>
                                    <option value='May'>May</option>
                                    <option value='Jun'>June</option>
                                    <option value='Jul'>July</option>
                                    <option value='Aug'>August</option>
                                    <option value='Sep'>September</option>
                                    <option value='Oct'>October</option>
                                    <option value='Nov'>November</option>
                                    <option value='Dec'>December</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="year">Year :</label>
                                <select class="form-control" id="select_year" name="year">
                                    <option value='2016'>2016</option>
                                    <option value='2017'>2017</option>
                                    <option value='2018'>2018</option>
                                    <option value='2019'>2019</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="panel panel-default col-sm-5" style="height: 250px;">
               <br><br><br>
                <label for="year">Fullname : </label> <span id="full_name"></span></br>
                <label for="year">Designation : </label> <span id="designation"></span></br>
                <label for="year">Month : </label> <span id="s_month"></span></br>
                <label for="year">Year : </label> <span id="s_year"></span></br>
                <label for="year">Target : </label> <span id="target"></span></br>
                <label for="year">Achieved : </label> <span id="achieved"></span></br>
                <label for="year">Lackings : </label> <span id="lackings"></span></br>
            </div>

            <div class="panel panel-default col-sm-7">
                <div id="chartContainer" style="height: 250px; width: 100%;"></div>
            </div>





            <div class="panel-body">
                    <table class="table table-bordered table-responsive" id = "full_tree">
                         <!-- php generated -->
                    </table>
            </div>

        </div>
    </div>
    <!--/.row-->
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
var p = 9;
var chart;
    $( document ).ready(function() {  
   



    
 chart = new CanvasJS.Chart("chartContainer",
    {
        title:{
            text: ""
        },
                animationEnabled: true,
        legend:{
            verticalAlign: "bottom",
            horizontalAlign: "center"
        },
        data: [
        {        
            indexLabelFontSize: 20,
            indexLabelFontFamily: "Monospace",       
            indexLabelFontColor: "darkgrey", 
            indexLabelLineColor: "darkgrey",        
            indexLabelPlacement: "outside",
            type: "pie",       
            showInLegend: true,
            toolTipContent: "{y} - <strong>#percent%</strong>",
            dataPoints: [
                {  y: 1, legendText:"Target", indexLabel: "Target" },
                {  y: 1, legendText:"Achieve" , indexLabel: "Achieve"},
                {  y: 1, legendText:"Dues" , indexLabel: "Dues"}
            ]
        }
        ]
    });
 //chart.render(); 
 



        var month = '<?php echo date('M'); ?>';
        $('#select_month').val(month);

        var year = '<?php echo date('Y'); ?>';
        $('#select_year').val(year);

        var boss_id = <?php echo $_SESSION['post_id'] ?>;
        var post_title = '<?php echo $_SESSION['user_type'] ?>';
        var to_be_replaced = '';
        
        function updateOptions(boss_id, to_be_replaced)
        {
            $.ajax({
                    url:"views/helper/tree_option.php",
                    data:{boss_id: boss_id},
                    dataType:"text",
                    method:"POST",
                    success:function(data){
                        $(to_be_replaced).html(data); 
                    }
            });
        }        
        
        function replaceOptions(post_title)
        {
            to_be_replaced = "#select_";
            
            if (post_title == "head")
            {
                to_be_replaced += 'manager';
                return to_be_replaced;
            }
            else if (post_title == "manager")
            {
                to_be_replaced += 'supervisor';
                return to_be_replaced;
            }
            else if (post_title == "supervisor")
            {
                to_be_replaced += 'sales_officer';
                return to_be_replaced;
            }
        }
       
        updateOptions(boss_id, replaceOptions(post_title));
        
        
        $( "#select_manager, #select_supervisor, #select_sales_officer").on( "change", function() {
           boss_id = $(this).val();
           post_title = $(this).attr('id').replace('select_', '');
           updateOptions(boss_id, replaceOptions(post_title));
        }); 
         
        
    
    
        $('#search').click( function () {   

            //alert(chart.options.data[0].dataPoints.length);

            if ($('#select_sales_officer option:selected').val() != 0)
            {
                boss_id = $('#select_sales_officer option:selected').val();
                post_title = 'sales_officer';
            }  
            else if ($('#select_supervisor option:selected').val() != 0)
            {
                boss_id = $('#select_supervisor option:selected').val();
                post_title = 'supervisor';
            }
            else if ($('#select_manager option:selected').val() != 0)
            {
                boss_id = $('#select_manager option:selected').val();
                post_title = 'manager';
            }
            else
            {
                boss_id = <?php echo $_SESSION['post_id'] ?>;
                post_title = 'head';
            }
           // alert(boss_id + "  " + post_title);
                     
            $.ajax({
                url:"tree.php",
                data:{boss_id: boss_id, post_type: post_title},
                dataType:"text",
                method:"POST",
                success:function(data){
                    $('#full_tree').html(data);
                    
                }
            });
            
            //alert("Boss id = " + boss_id + "\n" + "post_title = " + post_title + "\n" + "month = " + $('#select_month option:selected').val() + "\n" + "year = " + $('#select_year option:selected').val() + "\n");
            
            $.ajax({
                url:"views/helper/tree_overview.php",
                data:{boss_id: boss_id, post_title: post_title, month:$('#select_month option:selected').val(), year: $('#select_year option:selected').val()},
                dataType:"text",
                method:"POST",
                success:function(data){
                //alert(data);
                   var obj = JSON.parse(data);
                  //alert(obj);
                  document.getElementById('full_name').innerHTML = obj.full_name;
                  document.getElementById('achieved').innerHTML = obj.achieved;
                  document.getElementById('target').innerHTML = obj.target ;
                  document.getElementById('lackings').innerHTML = obj.target- obj.achieved;
                  document.getElementById('designation').innerHTML = post_title;
                  document.getElementById('s_month').innerHTML = $('#select_month option:selected').val();
                  document.getElementById('s_year').innerHTML = $('#select_year option:selected').val();
                    

                  chart.options.data[0].dataPoints[0].y = obj.target;
                  chart.options.data[0].dataPoints[1].y = obj.achieved;
                  chart.options.data[0].dataPoints[2].y = obj.target- obj.achieved;
                chart.render();
            
                }
            });
            
            
        });

    });
</script>

