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
                'schoolings': {
                    required: true
                }
            }
            });
        }

        if (jqEditForm.length) {
            jqEditForm.validate({
            rules: {
                'name': {
                    required: true
                },
                'schoolings': {
                    required: true
                }
            }
            });
        }


        
    });

</script><?php /**PATH C:\xampp\htdocs\csiledesroses\resources\views/class/js/validation.blade.php ENDPATH**/ ?>