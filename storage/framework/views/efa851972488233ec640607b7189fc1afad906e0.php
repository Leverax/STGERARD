<?php echo $__env->make('student.js.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('student.js.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('student.js.validation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
</script><?php /**PATH C:\wamp64\www\review\cspyramides\resources\views/student/js/default_functions.blade.php ENDPATH**/ ?>