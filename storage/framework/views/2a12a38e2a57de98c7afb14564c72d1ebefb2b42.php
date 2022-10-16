<script>

    $(function () {
        'use strict';

        var jqCreateForm = $('#create-form');
        var jqEditForm = $('#edit-form');

        // jQuery Validation for Create form
        // --------------------------------------------------------------------
        if (jqCreateForm.length) {
            jqCreateForm.validate({
            rules: {
                'academic_year': {
                    required: true
                },
                'motif': {
                    required: true
                },
                'amount': {
                    required: true
                }
            }
            });
        }

        if (jqEditForm.length) {
            jqEditForm.validate({
            rules: {
                'academic_year': {
                    required: true
                },
                'motif': {
                    required: true
                },
                'amount': {
                    required: true
                } 
            }
            });
        }


        
    });

</script><?php /**PATH C:\xampp\htdocs\csiledesroses\resources\views/recipe/js/validation.blade.php ENDPATH**/ ?>