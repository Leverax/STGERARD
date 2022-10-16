<?php echo $__env->make('academic_year.js.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('academic_year.js.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('academic_year.js.validation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
        var route = "<?php echo e(route('academic_year.state' , ':id')); ?>"
            route = route.replace(':id' , id)
        
        $.get(route, function(data){
            location.reload();
            msg_act_ele(data.response, "Année académique activée." , "Année académique désactivée.")
        });
    }
</script><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/academic_year/js/default_functions.blade.php ENDPATH**/ ?>