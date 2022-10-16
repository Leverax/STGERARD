<script>
    function editAcademic_year(id){ // For delete a category
        
        var route = '{{route("academic_year.edit" , ":id")}}'
            route = route.replace(':id' , id)

        var route_update = '{{route("academic_year.update" , ":id")}}'
            route_update = route_update.replace(':id' , id)

        $('#edit-modal #edit-form').attr('action' , route_update)

        $.get(route, function(data){
            $('#edit-modal #name').val(data.name);
        });
        
    }
</script>