(function ($) {
    $(function () {

        $('#edit-priority').multiselect({
            includeSelectAllOption: true

        });

        $('#edit-status').multiselect({
            includeSelectAllOption: true

        });
        
        $('#edit-type').multiselect({
            includeSelectAllOption: true
            
        });
        
        $('#edit-per-page').multiselect({
            includeSelectAllOption: true
            
        });
        
        $('#apply').click(function (e) {
          //  alert($('#priority').val());
          //  alert($('#status').val());
            $.ajax({
                type:'POST',
                url: '',
                data: 'name=Test',
    	        success: function(message) {
    	           alert($('#priority').val());
    	           }
            });
            e.preventDefault();
        });
    });
    
$(document).ready(function(){
    var height = $("#full-container").height();
    var width = $("#full-container").width();
    var height1 = $("#ticket-details").height();
    var height2 = $("#tickets-list").height();
    //alert(height);
    
    var h = height1+height2/2;
    
    if(height1<500){
        //alert(width);
        if(width<720){
            //$("#navbar-inverse-sidebar").height(0);
        }
        else{
            //alert();
                $("#navbar-inverse-sidebar").height(965);
            //$("#navbar-inverse-sidebar").height();
        }
        
       // alert(965); 
    }
    else if(h<900){
    
        $("#navbar-inverse-sidebar").height(height1+height2);
        //alert(height1+height2);      
    }
    else{
        $("#navbar-inverse-sidebar").height(h);
        //alert(h);
    }

    });
})(jQuery);
