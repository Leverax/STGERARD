<script>
    function deleteAcademic_year(id , name){ // For delete a category
        modals_alert('deleteModal','danger')
        $('.title_elmt').text("Suppression de l'année académique")
        $('.desc_elmt').text("Voulez vous vraiment supprimer l'année académique "+name+" ?")

        var route = '{{route("academic_year.destroy" , ":id")}}'
            route = route.replace(':id' , id)

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