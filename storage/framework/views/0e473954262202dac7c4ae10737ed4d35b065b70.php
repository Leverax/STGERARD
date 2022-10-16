<?php echo $__env->make('expense.js.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('expense.js.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('expense.js.validation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    dataTable(
        "Ajouter une dépense",
        [0, 1, 2, 3, 4 , 5 , 6 , 7],
        {
            label : 'Ajouter',
            modal_id : '#create-modal'
        },
        {
            rowGroup : [1 , 2],
            columnDefs : [1, 2]
        }
    )
</script><?php /**PATH C:\xampp\htdocs\csiledesroses\resources\views/expense/js/default_functions.blade.php ENDPATH**/ ?>