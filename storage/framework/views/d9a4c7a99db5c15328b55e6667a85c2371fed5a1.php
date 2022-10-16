<script>
    function editStudent(id){ // For delete a category
        
        var route = '<?php echo e(route("student.edit" , ":id")); ?>'
            route = route.replace(':id' , id)

        var route_update = '<?php echo e(route("student.update" , ":id")); ?>'
            route_update = route_update.replace(':id' , id)

        $('#edit-modal #edit-form').attr('action' , route_update)

        $.get(route, function(data){
            $('#edit-modal #lastname').val(data.lastname);
            $('#edit-modal #firstname').val(data.firstname);
            $('#edit-modal #backward').val(data.backward);
            $('#edit-modal #indicative').val(data.indicative);
        });
        
    }
</script><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/student/js/edit.blade.php ENDPATH**/ ?>