{{-- <script>
    function deleteSchooling(id , tranche){ // For delete a category
        modals_alert('deleteModal','danger')
        $('.title_elmt').text("Suppression de reçu")
        $('.desc_elmt').text("Voulez vous vraiment supprimer le reçu du versement "+tranche+" ?")

        var route = '{{route("schooling_details.destroy" , ":id")}}'
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
</script> --}}





<script>

    function deleteSchooling(id, number){
        
        
        if (confirm("Cette suppresion est irréversible. Voulez vous vraiment supprimer le reçu "+number+" ?") === true) {

            var route = '{{route("schooling_details.remove" , ":id")}}'
                route = route.replace(':id' , id)

                $.ajax({
                    type: "GET",
                    url: route,
                    success: function(data) {
                        if (data.response === 'success') {
                            message_alert('success',"Reçu supprimé avec succès.",'#alert-details',5000)
                        }else{
                            message_alert('danger',"Reçu non supprimé.",'#alert-details',5000)
                        }
                        
                        refresh_schooling_table()
                    },
                    error: function(err){
                        console.log(err)
                    }
                });

        } else {
            
        }

    
    }


    // function destroySchooling(id){

    // }

    function destroySchooling(id){ // For destroy a schooling
        console.log('good')
        modals_alert('deleteModal','danger')
        $('.title_elmt').text("Suppression de scolarité")
        $('.desc_elmt').text("Voulez vous vraiment supprimer cette scolarité ? Car elle entraine la suppression de tous les reçus associé à cette scolarité.")

        var route = '{{route("schooling.destroy" , ":id")}}'
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