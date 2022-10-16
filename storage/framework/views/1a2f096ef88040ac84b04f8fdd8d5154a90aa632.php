<script>
    function editRecipe(id){ // For delete a category
        
        var route = '<?php echo e(route("recipe.edit" , ":id")); ?>'
            route = route.replace(':id' , id)

        var route_update = '<?php echo e(route("recipe.update" , ":id")); ?>'
            route_update = route_update.replace(':id' , id)

        $('#edit-modal #edit-form').attr('action' , route_update)

        $.get(route, function(data){
            $('#edit-modal #academic_year').val(data.academic_years_id).change();
            $('#edit-modal #motif').val(data.motif);
            $('#edit-modal #amount').val(data.amount);
        });
        
    }
</script><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/recipe/js/edit.blade.php ENDPATH**/ ?>