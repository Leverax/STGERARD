<script>
    function editClassroom(id){ // For delete a category
        
        

        var route = '{{route("classroom.edit" , ":id")}}'
            route = route.replace(':id' , id)

        var route_update = '{{route("classroom.update" , ":id")}}'
            route_update = route_update.replace(':id' , id)

        $('#edit-modal #edit-form').attr('action' , route_update)

        $.get(route, function(data){
            $('#edit-modal #name').val(data.name);
            $('#edit-modal #schoolings').val(data.schoolings);
        });
        
    }
</script>