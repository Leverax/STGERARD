<script>
    function remainder_to_pay(){
        
        var student_id       = $('#student').val()
        var academic_year_id = $('#academic_year').val()
        var classroom_id     = $('#classroom').val()
        
        var route = '<?php echo e(route("schooling.get_rest" , [":student_id" , ":academic_year_id" , ":classroom_id"])); ?>'
            route = route.replace(':student_id' , student_id)
            route = route.replace(':academic_year_id' , academic_year_id)
            route = route.replace(':classroom_id' , classroom_id)
        
        $.ajax({
            type: "GET",
            url: route,
            success: function(data) {

                // Show backward
                if (data.student) {
                    $('#backward').val(data.student.backward)
                }else{
                    $('#backward').attr('disabled' , 'disabled')
                }
                // Show rest for academic year
                if (data.old_rest) {
                    $('#rest').val(data.rest - $('#amount').val())
                }else{
                    $('#rest').val(data.rest - $('#amount').val() + data.student.backward)
                }
                
                // Show list to rests by academic year
                $('#recap-rest').empty();
                data.rests.forEach(rest => {
                    $('#recap-rest').append("<li> "+rest[0].name+" : "+rest[1].rest+" F CFA</li>")
                });

                if ($('#rest').val() < 0) {
                    $('#btn-save').attr('disabled' , 'disabled')
                }else{
                    $('#btn-save').removeAttr('disabled')
                }
                
            },
            error: function(err){
                console.log(err)
            }
        });

    }
</script><?php /**PATH C:\wamp64\www\review\cspyramides\resources\views/schooling/js/create.blade.php ENDPATH**/ ?>