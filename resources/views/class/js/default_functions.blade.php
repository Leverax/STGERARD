@include('class.js.delete')
@include('class.js.edit')
@include('class.js.validation')

<script>
    dataTable(
        "Ajouter une classe",
        [0, 1, 2, 3, 4, 5],
        {
            label : 'Ajouter',
            modal_id : '#create-modal'
        },
    )
</script>