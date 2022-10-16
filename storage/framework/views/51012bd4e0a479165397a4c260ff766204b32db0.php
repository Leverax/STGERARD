

<?php $__env->startSection('title-page'); ?> Autres recettes <?php $__env->stopSection(); ?>

<?php $__env->startSection('styles-page'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/vendors.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/plugins/forms/form-validation.css'); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('components.breadcrumbs' , [
        'title_page'    => "Liste des autres recettes",
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-page'); ?>
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="">
                        <div class="card-body p-1">
                            <table class="table" id="table">
                                <thead>
                                <tr class="text-center">
                                    <th>N°</th>
                                    <th>Année académique</th>
                                    <th>Motif</th>
                                    <th>Montant</th>
                                    <th>Date de création</th>
                                    <th>Par</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
            
                                <?php $__currentLoopData = $recipes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $recipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-center">
                                        <td><?php echo e(++$key); ?></td>
                                        <td><?php echo e($recipe->academic_years->name); ?></td>
                                        <td><?php echo e($recipe->motif); ?></td>
                                        <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($recipe->amount)); ?> F CFA</td>
                                        <td><?php echo e($recipe->created_at); ?></td>
                                        <td><?php echo e($recipe->users->firstname.' '.$recipe->users->lastname); ?></td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-primary waves-effect waves-float waves-light" title="Modifier la recette" onclick="editRecipe('<?php echo e($recipe->id); ?>')" data-toggle="modal" data-target="#edit-modal"> <i data-feather='edit'></i> </a>
                                            <a class="btn btn-icon btn-danger waves-effect waves-float waves-light" title="Supprimer la recette"  onclick="deleteRecipe('<?php echo e($recipe->id); ?>','<?php echo e($recipe->motif); ?>')" data-toggle="modal" data-target="#deleteModal"> <i data-feather='trash-2'></i> </a>
                                       
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td></td>
                                        <td>Total</td>
                                        <td></td>
                                        <td><strong><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($recipes->sum('amount')).' F CFA'); ?></strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal to add new user -->
        <?php echo $__env->make('recipe.modal.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts-page-vendor'); ?>

    <script src="<?php echo asset('/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo asset('/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js'); ?>"></script>
    <script src="<?php echo asset('/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?php echo asset('/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js'); ?>"></script>
    
    <script src="<?php echo asset('/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js'); ?>"></script>
    <script src="<?php echo asset('/app-assets/vendors/js/tables/datatable/buttons.html5.min.js'); ?>"></script>
    <script src="<?php echo asset('/app-assets/vendors/js/tables/datatable/buttons.print.min.js'); ?>"></script>
    <script src="<?php echo asset('/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js'); ?>"></script>

    <script src="<?php echo asset('/app-assets/vendors/js/tables/datatable/jszip.min.js'); ?>"></script>
    <script src="<?php echo asset('/app-assets/vendors/js/tables/datatable/pdfmake.min.js'); ?>"></script>
    <script src="<?php echo asset('/app-assets/vendors/js/tables/datatable/vfs_fonts.js'); ?>"></script> 
    <script src="<?php echo asset('/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js'); ?>"></script>

    <script src="<?php echo asset('/app-assets/vendors/js/forms/validation/jquery.validate.min.js'); ?>"></script>

    <script src="<?php echo asset('/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js'); ?>"></script>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts-page'); ?>
    <script src="<?php echo asset('/app-assets/js/scripts/tables/table-datatables-basic.min.js'); ?>"></script>
    <?php echo $__env->make('recipe.js.default_functions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/recipe/list.blade.php ENDPATH**/ ?>