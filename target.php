<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Target View</div>

                <div class="panel-body" style="padding-bottom: 5px;">
                    <div class="col-sm-10">
                        <div class="form-inline">
                            <div class="form-group col-sm-4">
                            <label for="month">Month :</label>
                                <select class="form-control" id="month" name="target_month">
                                    <option value=''>--Select Month--</option>
                                    <option selected value='January'>January</option>
                                    <option value='February'>February</option>
                                    <option value='March'>March</option>
                                    <option value='April'>April</option>
                                    <option value='May'>May</option>
                                    <option value='June'>June</option>
                                    <option value='July'>July</option>
                                    <option value='August'>August</option>
                                    <option value='September'>September</option>
                                    <option value='October'>October</option>
                                    <option value='November'>November</option>
                                    <option value='December'>December</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="year">Year :</label>
                                <select class="form-control" id="year" name="year">
                                    <option value='2016'>2016</option>
                                    <option value='2017'>2017</option>
                                    <option value='2018'>2018</option>
                                    <option value='2019'>2019</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary" id="search"><span class="glyphicon glyphicon-search" ></span></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 pull-left">

                    </div>
                </div>

                <div class="panel-body">
                    <div class="col-lg-10">
                        <table class="table table-bordered table-responsive" id = "target_details_table">
                             <!-- php generated -->
                    </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!--/.row-->

</div>



<div class="modal" id="assign_target_modal" role="dialog">
    <div class="modal-dialog modal-sm">
          <div class="modal-content">                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id = "modal_target_title">Set Target</h4>
                    </div>
                    
                    
                    <div class="modal-body">
                            <p id="target_post_id" hidden="true">A</p>                        
                            <h2 id = "month_selection">Month Name</h2>
                                                      
                            <label for="target_amount">Target Money</label>
                            <input id="target_amount" class="form-control" type="number" placeholder="" name="target_money">
                            <br><br><br>

                            <button type="submit" name='save' id = 'target_save' class="btn btn-primary btn-block">Save</button>
                    </div>                  
                    
             </div>
     </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>

    $( document ).ready(function() {
        var element;
        $('#search').click( function () {            
            $.ajax({
                url:"views/helper/target_table.php",
                data:{month:$('#month option:selected').val(), year:$('#year option:selected').val(), user_id: <?php echo $_SESSION['user_id'] ?>},
                dataType:"text",
                method:"POST",
                success:function(data){
                    $('#target_details_table').html(data);
                }
            });
        });
    
    
    
        $(document).on("click", '.table button', function () { 
             element = $(this);
             $('#target_post_id').text($(this).attr('id'));  
             $('#month_selection').text($('#month option:selected').val()); 
             $('#target_amount').val("");                       
             $('#assign_target_modal').modal('show'); 
             //alert("Your post id = " + $('#target_post_id').text());
             $.ajax({
                url:"views/helper/check_target.php",
                data:{month:$('#month_selection').text(), year:$('#year option:selected').val(), post_id: $('#target_post_id').text()},
                dataType:"text",
                method:"POST",
                success:function(data){
                    var obj = JSON.parse(data);
                    $('#target_amount').val(obj.amount);                     
                }
            });
        });


        $('#target_save').click(function()
         {            
            $.ajax({
                url:"views/helper/target_assign.php",
                data:{post_id: $("#target_post_id").text() , month:$('#month_selection').text(), year:$('#year option:selected').val(), 
                        amount:$("#target_amount").val()},
                dataType:"text",
                method:"POST",
                success:function(data){
                    if (data == "1") 
                    {
                        element.parent().parent().find('td:nth-child(4)').html($("#target_amount").val());
                        //location.reload();
                        $('#assign_target_modal').modal('hide'); 
                    }
                    else if (data == "0") alert("An error occurred");
                    else if (data == "11") {
                        //alert("Updated successfully");
                      //  alert();
                        element.parent().parent().find('td:nth-child(4)').html($("#target_amount").val());
                        //location.reload();
                        $('#assign_target_modal').modal('hide'); 

                    }
                }
            });
                        
         });
    });
</script>

