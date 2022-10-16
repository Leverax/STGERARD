<script>
    function editExpense(id){ // For delete a category
        
        var route = '<?php echo e(route("expense.edit" , ":id")); ?>'
            route = route.replace(':id' , id)

        var route_update = '<?php echo e(route("expense.update" , ":id")); ?>'
            route_update = route_update.replace(':id' , id)

        $('#edit-modal #edit-form').attr('action' , route_update)

        $.get(route, function(data){
            $('#edit-modal #academic_year').val(data.academic_years_id).change();
            $('#edit-modal #cycle').val(data.cycle).change();
            $('#edit-modal #motif').val(data.motif);
            $('#edit-modal #amount').val(data.amount);
        });
        
    }
</script><?php /**PATH C:\xampp\htdocs\csiledesroses\resources\views/expense/js/edit.blade.php ENDPATH**/ ?>