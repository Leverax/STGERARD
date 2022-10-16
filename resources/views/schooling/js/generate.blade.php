<script>
    
    function genetateSchooling(id, number){
        
        
        if (confirm("Cette génération est irréversible. Voulez vous vraiment générer le reçu "+number+" ?") === true) {

            var route = '{{route("schooling_details.generate" , ":id")}}'
                route = route.replace(':id' , id)

                $.ajax({
                    type: "GET",
                    url: route,
                    success: function(data) {
                        if (data.response === 'success') {
                            message_alert('success',"Reçu généré avec succès.",'#alert-details',5000)
                        }else{
                            message_alert('error',"Reçu non généré.",'#alert-details',5000)
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

</script>