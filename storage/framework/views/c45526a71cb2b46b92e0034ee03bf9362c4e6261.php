<?php echo $__env->make('class.js.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('class.js.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('class.js.validation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    dataTable(
        "Ajouter une classe",
        [0, 1, 2, 3, 4, 5],
        {
            label : 'Ajouter',
            modal_id : '#create-modal'
        },
    )
</script><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/class/js/default_functions.blade.php ENDPATH**/ ?>