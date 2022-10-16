@include('academic_year.js.delete')
@include('academic_year.js.edit')
@include('academic_year.js.validation')

<script>
    dataTable(
        "Ajouter une année académique",
        [0, 1, 2, 3, 4, 5],
        {
            label : 'Ajouter',
            modal_id : '#create-modal'
        },
    )

    function state(id){
        var route = "{{ route('academic_year.state' , ':id') }}"
            route = route.replace(':id' , id)
        
        $.get(route, function(data){
            location.reload();
            msg_act_ele(data.response, "Année académique activée." , "Année académique désactivée.")
        });
    }
</script>