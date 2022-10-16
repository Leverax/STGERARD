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

</script>