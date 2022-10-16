<script>
    function deleteExpense(id , name){ // For delete a category
        modals_alert('deleteModal','danger')
        $('.title_elmt').text("Suppression de la recette")
        $('.desc_elmt').text("Voulez vous vraiment supprimer la dépense ' "+name+" ' ?")

        var route = '<?php echo e(route("expense.destroy" , ":id")); ?>'
            route = route.replace(':id' , id)

        $('#btn-modal-continuous').hide(300);

        if (!$('#delete_form').length) {
            $('#deleteModal .modal-footer').append(`
                <form id="delete_form" action="${route}" method="POST">
                    <?php echo method_field('DELETE'); ?>
                    <?php echo csrf_field(); ?>
                    <button type="submit" id="delete" class="btn btn-danger">Supprimer</button>
                </form>
            `)
        }
    }
</script><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/expense/js/delete.blade.php ENDPATH**/ ?>