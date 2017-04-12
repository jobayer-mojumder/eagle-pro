<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

  <div class="col-lg-12">
      <div class="panel panel-default">
          <div class="panel-heading">Service Order View</div>                
               <div class="panel-body">
               <div class="form-group col-sm-3">
                                <label for="month">Sales Officer :</label>
                                <select class="form-control" id="select_sales_officer" name="sales_officer">
                                    <?php include('views/helper/select_sales_officer.php'); ?>
                                </select>
                            </div>
                   
                  
                    <table class="table table-bordered table-responsive" id = 'order_table'">
                                                   
                            
                            <?php include('views/helper/order_table.php') ?>
                            
                            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready( function () { 
    
        $( "#select_sales_officer").on( "change", function() {
           filter($(this).val());
        });
        
        $('#select_month').val('<?php echo date('M'); ?>');
        $('#select_year').val('<?php echo date('Y'); ?>');
    
       function filter(value) {
            if (value == 0)
            {
                $("#order_table tr").each(function(index) {
                    if (index !== 0) {
                        $(this).show();
                    }
                });
            }
            else
            {            
                $("#order_table tr").each(function(index) {
                    if (index !== 0) {

                        $row = $(this);

                        var id = $row.children().eq(1).text().toLowerCase();

                        if (!id.match(value)) {
                            $row.hide();
                        }
                        else {
                            $row.show();
                        }
                    }
                });
            }
        }    
    
        $('td.approve a, td.decline a').click( function () { 
        
            var order_id = $(this).attr('id'); 
               //alert($(this).parent().attr('class'));     
            $.ajax({
               url:"views/helper/review_order.php",
                        data:{order_id: order_id, operation:$(this).parent().attr('class')},
                        dataType:"text",
                        method:"POST",
                        success:function(data){
                           location.reload();
                           //alert(data);
                     }
               });
            
        });
           
           
    });
</script>
