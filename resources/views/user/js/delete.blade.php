<script>
    function deleteUsers(id , name){ // For delete a category
        modals_alert('deleteModal','danger')
        $('.title_elmt').text("Suppression d'utilisateur")
        $('.desc_elmt').text("Voulez vous vraiment supprimer l'utilisateur de "+name+" ?")

        var route = '{{route("utilisateur.destroy" , ":id")}}'
            route = route.replace(':id' , id)
        // $('#delete_form').attr('action',route);

        $('#btn-modal-continuous').hide(300);

        if (!$('#delete_form').length) {
            $('#deleteModal .modal-footer').append(`
                <form id="delete_form" action="${route}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" id="delete" class="btn btn-danger">Supprimer</button>
                </form>
            `)
        }
        
    }
</script>