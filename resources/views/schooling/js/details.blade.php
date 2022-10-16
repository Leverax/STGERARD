<script>

    let schooling_table = $('#details-schooling').DataTable();

    function ShowDetailsSchooling(id){ // For delete a category
        
        var route = "{{ route('schooling_details.index' , ':id') }}"
            route = route.replace(':id' , id)

        schooling_table.destroy();
        schooling_table = $('#details-schooling').DataTable({
            // stateSave: true,
            processing: true,
            serverSide: false,

            ajax: {
                'url' : route,
                // success : function (data) {
                //     console.log(data)
                // },
                // error : function(err){
                //     console.log(err)
                // }
            },
            columns: [
                {data: 'number', name: 'number'},
                {data: 'tranche', name: 'tranche'},
                {data: 'date', name: 'date'},
                {data: 'amount', name: 'amount'},
                {data: 'backward', name: 'backward'},
                {data: 'author', name: 'author'},
                {data: 'action', name: 'action'},
            ],
            "rowCallback": function( row, data ) {
                // console.log(row , data)
            },
        });
        
    }

    // For import schoolings
    function refresh_schooling_table(){
        schooling_table.ajax.reload(null, false);
    }

</script>