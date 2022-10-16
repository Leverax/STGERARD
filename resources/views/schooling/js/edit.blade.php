<script>

    var schooling_rest = 0;
    var schooling_amount = 0;

    function editSchooling(id){
        var route_edit = '{{route("schooling_details.edit" , ":id")}}'
            route_edit = route_edit.replace(':id' , id)


        $.ajax({
            type: "GET",
            url: route_edit,
            success: function(data) {
                
                $('#edit-modal #amount').val(data.schoolingDetails.amount)
                $('#edit-modal #rest').val(data.schooling.rest)
                schooling_rest   = data.schooling.rest
                schooling_amount = data.schoolingDetails.amount
                
                $('#edit-modal #btn-submit').attr('onclick' , "updateSchooling("+id+")")
                
            },
            error: function(err){
                    
            }
        });
            
    }

    
    function updateSchooling(id) {

        var route = '{{route("schooling_details.update" , ":id")}}'
            route = route.replace(':id' , id)
            
        $.ajax({
            type: "PUT",
            url: route,
            data: {
                'amount' : $('#edit-form #amount').val()
            },
            success: function(data) {
                console.log(data)
                if (data.response === 'success') {
                    message_alert('success',"Reçu modifié avec succès.",'#alert-details',5000)
                }else{
                    message_alert('warning',"Reçu non modifié.",'#alert-details',5000)
                }
                
                refresh_schooling_table()
            },
            error: function(err){
                console.log(err)
            }
        });
    }

    function remainder_edit_to_pay(){
        
        $('#edit-form #rest').val( parseInt(schooling_rest) + parseInt(schooling_amount) - parseInt($('#edit-form #amount').val()) )
     
        if ( $('#edit-form #rest').val() < 0 ) {
            $('#edit-form #btn-submit').attr('disabled' , 'disabled')
        }else{
            $('#edit-form #btn-submit').removeAttr('disabled')
        }
    }
</script>