<script>
    function getState(){
        var year_id = $('#academic_year').val()
        var route = '<?php echo e(route("etat.search" , ":year_id")); ?>'
            route = route.replace(':year_id' , year_id)

        $.ajax({
            type: "GET",
            url: route,
            success: function(data) {
                // console.log(new Intl.NumberFormat().format(20000))
                $('#n_register').html(data.n_register)
                $('#n_sold').html(data.n_sold)
                $('#n_unsold').html(data.n_unsold)
                $('#backward_count').html(data.backward_count)

                $('#expense').html(new Intl.NumberFormat().format(data.expense)+' FCFA')
                $('#recipe').html(new Intl.NumberFormat().format(data.recipe)+' FCFA')
                $('#gain').html(new Intl.NumberFormat().format(data.amount_total + data.recipe - data.expense)+' FCFA')


                $('#backward_sum').html(new Intl.NumberFormat().format(data.backward_sum)+' FCFA')
                $('#amount_today').html(new Intl.NumberFormat().format(data.amount_today)+' FCFA')
                $('#amount_total').html(new Intl.NumberFormat().format(data.amount_total)+' FCFA')
            },
            error: function(err){
                console.log(err)
            }
        });
    }

    let btn_generate = $('#btn_generate')
        btn_generate.addClass('disabled')

    function exportExcel(){
        var start_date  = $('#start_date').val()
        var end_date    = $('#end_date').val()
        // let btn_generate = $('#btn_generate')
        console.log(start_date+" "+end_date)
        if (start_date && end_date) {
            // Generate export excel
            btn_generate.removeClass('disabled')
            var route_export = "<?php echo e(route('export.excel' , [':start_date' , ':end_date'])); ?>"
                route_export = route_export.replace(':start_date' , start_date)
                route_export = route_export.replace(':end_date' , end_date)
            btn_generate.attr('href' , route_export)
        }else{
            btn_generate.addClass('disabled')
        }
    }


    let btn_generate_by_sort = $('#btn_generate_by_sort')
        btn_generate_by_sort.addClass('disabled')

    function exportExcelByYearAndClass(){
        var academic_year_sort  = $('#academic_year_sort').val()
        var classroom_sort      = $('#classroom_sort').val()
        
        // let btn_generate = $('#btn_generate')
        if (academic_year_sort && classroom_sort) {
            // Generate export excel
            btn_generate_by_sort.removeClass('disabled')
            var route_export = "<?php echo e(route('export.sort_excel' , [':academic_year' , ':classroom'])); ?>"
                route_export = route_export.replace(':academic_year' , academic_year_sort)
                route_export = route_export.replace(':classroom' , JSON.stringify(classroom_sort))
            btn_generate_by_sort.attr('href' , route_export)
        }else{
            btn_generate_by_sort.addClass('disabled')
        }
    }
</script><?php /**PATH C:\wamp64\www\review\cspyramides\resources\views/state/js/default_functions.blade.php ENDPATH**/ ?>