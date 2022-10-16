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
                'student': {
                    required: true
                },
                'classroom': {
                    required: true
                },
                'amount': {
                    required: true
                },
            }
            });
        }

        if (jqEditForm.length) {
            jqEditForm.validate({
            rules: {
                'academic_year': {
                    required: true
                },
                'student': {
                    required: true
                },
                'classroom': {
                    required: true
                },
                'amount': {
                    required: true
                },
            }
            });
        }


        
    });

</script>