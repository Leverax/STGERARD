@include('schooling.js.delete')
@include('schooling.js.edit')
@include('schooling.js.details')
@include('schooling.js.validation')
@include('schooling.js.create')
@include('schooling.js.generate')
{{-- @include('schooling.js.download') --}}

<script>
    dataTable(
        "Ajouter une facture",
        [0, 1, 2, 3, 4, 5],
        {
            label : 'Ajouter',
            modal_id : '#create-modal'
        },
        {
            rowGroup : [1 , 2],
            columnDefs : [1, 2]
        }
    )
    
    // Init select2
    $(document).ready(function() {
        ajax_search_student()
        // ajax_classroom_student()
        $('#classroom').select2({
            theme: 'bootstrap4',
            allowClear: true,
            language: "fr",
            placeholder: "Choisir une classe",
        })
    })

    // Function for search student
    function ajax_search_student(){
       
        academic_year_id = $('#academic_year :selected').val();
        // console.log(academic_year_id)
        // define route for get products
        var route = "{{ route('student.getStudent' , ':academic_year_id') }}"
            // set routes parameters
            route = route.replace(':academic_year_id' , academic_year_id)
        // Get ID element
        id = "#student";

        // destroys select2 attributes if exist
        if ($(id).data("select2")) {
            $(id).select2("destroy")
        }
        
        // Get product by ajax
        $(id).select2({
            theme: 'bootstrap4',
            allowClear: true,
            language: "fr",
            placeholder: "Choisir l'élève",
            ajax: {
                url: function (params) {
                    return route + "?search=" + params.term ;
                },
                success:function(data){
                    // console.log($('#academic_year :selected').val())
                },
                error:function(err){
                    console.log(err)
                },
                dataType: 'json',
                delay: 250,
                minimumInputLength: 2,
                processResults: function (data) {
                    result = [];
                    // console.log(data.search)
                    data.students.forEach((student , index) => {
                        result.push({
                            id: student.id, 
                            text: student.indicative ? 
                            student.indicative+' : '+student.lastname + " "+student.firstname + " ("+ student.matricule +")" : 
                            student.lastname +" "+student.firstname + " ("+ student.matricule +")"
                        })
                    });
                    
                    return {
                        results: result
                    };
                }
            }
        });
    }



    function ajax_search_classroom(){
       
       academic_year_id = $('#academic_year :selected').val();
       student_id = $('#student :selected').val();
       
       // define route for get products
       var route = "{{ route('classroom.getClassroom' , [':academic_year_id' , ':student_id']) }}"
           // set routes parameters
           route = route.replace(':academic_year_id' , academic_year_id)
           route = route.replace(':student_id' , student_id)
       // Get ID element
       id = "#classroom";

       // destroys select2 attributes if exist
       if ($(id).data("select2")) {
           $(id).select2("destroy")
       }
       
       // Get product by ajax
       $(id).select2({
           theme: 'bootstrap4',
           allowClear: true,
           language: "fr",
           placeholder: "Choisir une classe",
           ajax: {
               url: function (params) {
                   return route + "?search=" + params.term ;
               },
               success:function(data){
                   // console.log($('#academic_year :selected').val())
               },
               error:function(err){
                   console.log(err)
               },
               dataType: 'json',
               delay: 250,
               minimumInputLength: 2,
               processResults: function (data) {
                   result = [];
                   console.log(data)
                   if (data.isArray) {
                        data.classrooms.forEach((classroom , index) => {
                            result.push({        
                                id: classroom.id, 
                                text: classroom.indicative ?
                                      classroom.name + " ("+ classroom.indicative +")" : 
                                      classroom.name
                            })
                        });
                   }else{
                        result.push({        
                            id: data.classrooms.id, 
                            text: data.classrooms.indicative ?
                                data.classrooms.name + " ("+ data.classrooms.indicative +")" :
                                data.classrooms.name
                        })
                   }
                   
                   
                   return {
                       results: result
                   };
               }
           }
       });
   }

</script>