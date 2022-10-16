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
                },
                'email': {
                    required: true,
                    email: true
                },
                'status': {
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
                },
                'email': {
                    required: true,
                    email: true
                },
                'status': {
                    required: true
                }
            }
            });
        }


        
    });

</script>