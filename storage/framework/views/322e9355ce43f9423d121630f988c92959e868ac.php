

<?php $__env->startSection('title-page'); ?> Factures <?php $__env->stopSection(); ?>

<?php $__env->startSection('styles-page'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/vendors.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/plugins/forms/form-validation.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/forms/select/select2.min.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/plugins/forms/pickers/form-pickadate.min.css'); ?>">
    
    <style>
        .select2-selection__arrow{
            display: none;
        }

        #student-content .select2 , #classroom-content .select2{
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
            padding-top: 8px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('components.breadcrumbs' , [
        'title_page'    => "Liste des factures",
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
                                        <th>Classe</th>
                                        <th>Elève</th>
                                        <th>Montant payé</th>
                                        <th>Reste</th>
                                        <th>Arriéré</th>
                                        <th>Total</th>
                                        <th>Statut</th>
                                        <th>Date de creation</th>
                                        <th>Par</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
            
                                <?php $__currentLoopData = $schoolings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schooling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-center">
                                        <td><?php echo e(++$key); ?></td>
                                        <td><?php echo e($schooling->academic_years->name); ?></td>
                                        <td><?php echo e($schooling->classrooms->name); ?> <?php echo e($schooling->classrooms->indicative ? '('.$schooling->classrooms->indicative.')' : ''); ?></td>
                                        <td><?php echo e($schooling->students->lastname.' '.$schooling->students->firstname.' ('.$schooling->students->matricule.')'); ?></td>
                                        <td><?php echo e(number_format( $schooling->schooling_details->sum('amount') , 0 , '' , ' ').' F CFA'); ?></td>
                                        <td><?php echo e(number_format( $schooling->rest , 0 , '' , ' ').' F CFA'); ?></td>
                                        <td><?php echo e(number_format( $schooling->backward , 0 , '' , ' ').' F CFA'); ?></td>
                                        <td><?php echo e(number_format( $schooling->total , 0 , '' , ' ').' F CFA'); ?></td>
                                        <td> 
                                            <?php if($schooling->rest > 0): ?> 
                                                <span class="badge badge-danger">Reste</span>  
                                            <?php else: ?> 
                                                <span class="badge badge-success">Soldé</span> 
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($schooling->created_at->format('d-m-Y')); ?></td>
                                        <td><?php echo e($schooling->users->lastname.' '.$schooling->users->firstname); ?></td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-warning waves-effect waves-float waves-light" title="Voir Détails" onclick="ShowDetailsSchooling('<?php echo e($schooling->id); ?>')" data-toggle="modal" data-target="#detail-modal"> <i data-feather='eye'></i> </a>
                                            <?php if(Auth::user()->status == 'admin'): ?>
                                                <a href="#" class="btn btn-icon btn-danger waves-effect waves-float waves-light" title="Supprimer la scholarité" onclick="destroySchooling('<?php echo e($schooling->id); ?>')" data-toggle="modal" data-target="#deleteModal"> <i data-feather='trash-2'></i> </a>
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
        <?php echo $__env->make('schooling.modal.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

    <script src="<?php echo asset('/app-assets/vendors/js/forms/select/select2.full.min.js'); ?>"></script>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts-page'); ?>
    <script src="<?php echo asset('/app-assets/js/scripts/tables/table-datatables-basic.min.js'); ?>"></script>
    <script src="<?php echo asset('/app-assets/js/scripts/forms/form-select2.min.js'); ?>"></script>
    
    <script src="<?php echo asset('/app-assets/js/scripts/forms/pickers/form-pickers.min.js'); ?>"></script>

    <?php echo $__env->make('schooling.js.default_functions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/schooling/list.blade.php ENDPATH**/ ?>