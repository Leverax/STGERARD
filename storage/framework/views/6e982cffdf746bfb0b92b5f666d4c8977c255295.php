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
        });
        
    }
</script><?php /**PATH C:\wamp64\www\review\cspyramides\resources\views/class/js/edit.blade.php ENDPATH**/ ?>