<?php echo $__env->make('recipe.js.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('recipe.js.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('recipe.js.validation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    dataTable(
        "Ajouter une recette",
        [0, 1, 2, 3 , 4 , 5],
        {
            label : 'Ajouter',
            modal_id : '#create-modal'
        },
        {
            rowGroup : [1],
            columnDefs : [1]
        }
    )
</script><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/recipe/js/default_functions.blade.php ENDPATH**/ ?>