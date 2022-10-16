@include('user.js.delete')
@include('user.js.edit')
@include('user.js.validation')

<script>
    dataTable(
        "Ajouter un utilisateur",
        [0, 1, 2, 3, 4, 5],
        {
            label : 'Ajouter',
            modal_id : '#create-modal'
        },
    )

    function state(id){
        var route = "{{ route('utilisateur.state' , ':id') }}"
            route = route.replace(':id' , id)
        
        $.get(route, function(data){
            msg_act_ele(data.response, "Utilisateur activé." , "Utilisateur désactivé.")
        });
    }
</script>