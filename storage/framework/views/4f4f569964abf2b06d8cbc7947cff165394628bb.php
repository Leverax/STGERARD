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
                'lastname': {
                    required: true
                },
                'firstname': {
                    required: true
                }
            }
            });
        }

        if (jqEditForm.length) {
            jqEditForm.validate({
            rules: {
                'lastname': {
                    required: true
                },
                'firstname': {
                    required: true
                }
            }
            });
        }


        
    });

</script><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/student/js/validation.blade.php ENDPATH**/ ?>