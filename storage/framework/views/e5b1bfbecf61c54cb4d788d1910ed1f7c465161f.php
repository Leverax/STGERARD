

<?php $__env->startSection('title-page'); ?> Années académiques <?php $__env->stopSection(); ?>

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
        'title_page'    => "Années académiques",
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
                                    <th>Active</th>
                                    <th>Année académique</th>
                                    <th>Date de creation</th>
                                    <th>Par</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
            
                                <?php $__currentLoopData = $academic_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $academic_year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-center">
                                        <td><?php echo e(++$key); ?></td>
                                        <td>
                                            <div class="demo-inline-spacing">
                                                <div class="custom-control custom-switch custom-switch-success mx-auto">
                                                    <input type="checkbox" class="custom-control-input" id="<?php echo e('enable_year_'.$key); ?>" onclick="state(<?php echo e($academic_year->id); ?>)" <?php if($academic_year->isActive): ?> checked <?php endif; ?> />
                                                    <label class="custom-control-label" for="<?php echo e('enable_year_'.$key); ?>" title="<?php echo e($academic_year->isActive ? "Désactiver l'année" : "Activer l'année"); ?>">
                                                        <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo e($academic_year->name); ?></td>
                                        <td><?php echo e($academic_year->created_at->format('d-m-Y')); ?></td>
                                        <td><?php echo e($academic_year->users->lastname.' '.$academic_year->users->firstname); ?></td>
                                        <td>
                                            
                                            <a href="#" class="btn btn-icon btn-primary waves-effect waves-float waves-light" title="Modifier la classe" onclick="editAcademic_year('<?php echo e($academic_year->id); ?>')" data-toggle="modal" data-target="#edit-modal"> <i data-feather='edit'></i> </a>
                                            <?php if($academic_year->schooling->isEmpty()): ?>
                                                <a class="btn btn-icon btn-danger waves-effect waves-float waves-light" title="Supprimer la classe"  onclick="deleteAcademic_year('<?php echo e($academic_year->id); ?>','<?php echo e($academic_year->name); ?>')" data-toggle="modal" data-target="#deleteModal"> <i data-feather='trash-2'></i> </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal to add new user -->
        <?php echo $__env->make('academic_year.modal.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
    <?php echo $__env->make('academic_year.js.default_functions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/academic_year/list.blade.php ENDPATH**/ ?>