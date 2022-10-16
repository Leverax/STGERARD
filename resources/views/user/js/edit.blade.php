<script>
    function editUser(id){ // For delete a category
        var route = '{{route("utilisateur.edit" , ":id")}}'
            route = route.replace(':id' , id)

        $.get(route, function(data){
            console.log(data.user);
            $('#edit-modal #lastname').val(data.user.lastname);
            $('#edit-modal #firstname').val(data.user.firstname);
            $('#edit-modal #email').val(data.user.email);
            $('#edit-modal #status').val(data.user.status); 
        });
        
    }
</script>