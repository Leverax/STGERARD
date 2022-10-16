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
                'name': {
                    required: true
                },
            }
            });
        }

        if (jqEditForm.length) {
            jqEditForm.validate({
            rules: {
                'name': {
                    required: true
                },
            }
            });
        }


        
    });

</script><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/academic_year/js/validation.blade.php ENDPATH**/ ?>