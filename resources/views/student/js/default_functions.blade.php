@include('student.js.delete')
@include('student.js.edit')
@include('student.js.validation')

<script>

    repeater_bloc(["#create-form"])

    dataTable(
        "Ajouter un élève",
        [0, 1, 2, 3, 4, 5],
        {
            label : 'Ajouter',
            modal_id : '#create-modal'
        },
    )
</script>