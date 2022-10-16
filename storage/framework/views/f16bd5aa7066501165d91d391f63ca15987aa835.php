<script>
    function editClassroom(id){ // For delete a category
        
        

        var route = '<?php echo e(route("classroom.edit" , ":id")); ?>'
            route = route.replace(':id' , id)

        var route_update = '<?php echo e(route("classroom.update" , ":id")); ?>'
            route_update = route_update.replace(':id' , id)

        $('#edit-modal #edit-form').attr('action' , route_update)

        $.get(route, function(data){
            $('#edit-modal #name').val(data.name);
            $('#edit-modal #schoolings').val(data.schoolings);
            $('#edit-modal #indicative').val(data.indicative);
        });
        
    }
</script><?php /**PATH C:\xampp\htdocs\csiledesroses\resources\views/class/js/edit.blade.php ENDPATH**/ ?>