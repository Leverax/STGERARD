


<?php $__env->startSection('title-page'); ?> Etats <?php $__env->stopSection(); ?>

<?php $__env->startSection('styles-page'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/vendors.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/forms/select/select2.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/plugins/forms/pickers/form-pickadate.min.css'); ?>">
    <style>
        .select2-selection__arrow{
            display: none;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-page'); ?>
    
    <div class="row pb-1">
        <div class="col-12 text-center">
            <h3> Récapitulatif </h3>
            <select name="academic_year" id="academic_year" class="select2 form-control" oninput="getState()">
                <?php $__currentLoopData = $academic_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $academic_year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($academic_year->id); ?>"><?php echo e($academic_year->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <!-- Line Chart Card -->
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" id="n_register"><?php echo e($n_register); ?></h2>
                        <p class="card-text">Inscrits</p>
                    </div>
                    <div class="avatar bg-light-primary p-50">
                        <div class="avatar-content">
                            <i data-feather="user-check" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" id="n_sold"> <?php echo e($n_sold); ?></h2>
                        <p class="card-text">Soldé</p>
                    </div>
                    <div class="avatar bg-light-success p-50">
                        <div class="avatar-content">
                            <i data-feather="check" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" id="n_unsold"><?php echo e($n_unsold); ?></h2>
                        <p class="card-text">Non soldé</p>
                    </div>
                    <div class="avatar bg-light-danger p-50">
                        <div class="avatar-content">
                            <i data-feather="slash" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" id="backward_count"><?php echo e($backward->count()); ?></h2>
                        <p class="card-text">Arriéré</p>
                    </div>
                    <div class="avatar bg-light-primary p-50">
                        <div class="avatar-content">
                            <i data-feather='corner-up-left' class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" style="color:rgb(198, 0, 0) !important;" id="backward_sum"><?php echo e($backward->sum('backward').' F CFA'); ?></h2>
                        <p class="card-text" style="color:rgb(198, 0, 0) !important;">Arriéré</p>
                    </div>
                    <div class="avatar bg-light-primary p-50" style="color:rgb(198, 0, 0) !important;">
                        <div class="avatar-content">
                            <i data-feather='corner-up-left' class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" id="amount_today"><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($amount[0])); ?> F CFA</h2>
                        <p class="card-text">Montant encaissé ajourd'hui</p>
                    </div>
                    <div class="avatar bg-light-info p-50">
                        <div class="avatar-content">
                            <i data-feather='check-circle' class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" style="color: rgb(8, 216, 8) !important;" id="amount_total"><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($amount[1])); ?> F CFA</h2>
                        <p class="card-text" style="color: rgb(8, 216, 8) !important;">Montant total encaissé</p>
                    </div>
                    <div class="avatar bg-light-success p-50" style="color: rgb(8, 216, 8) !important;">
                        <div class="avatar-content">
                            <i data-feather='users' class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
      
        
    </div>

    <div class="row">
        <div class="col-lg-4 form-group">
            <label for="start_date">Du</label>
            <input type="text" id="start_date" oninput="exportExcel()" name="start_date" class="form-control flatpickr-basic bg-white" placeholder="YYYY-MM-DD" />
        </div>
        <div class="col-lg-4 form-group">
            <label for="end_date">Au</label>
            <input type="text" id="end_date" oninput="exportExcel()" name="end_date" class="form-control flatpickr-basic bg-white" placeholder="YYYY-MM-DD" />
        </div>
        <div class="col-lg-4 form-group">
            <a id="btn_generate" class="btn btn-primary" style="position: absolute; bottom:0px; width:90%;"><i data-feather='download'></i> Exportation</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 form-group">
            <label for="start_date">Année Academique</label>
            <select name="academic_year_sort" id="academic_year_sort" class="form-control select2" oninput="exportExcelByYearAndClass()">
                <?php $__currentLoopData = $academic_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $academic_year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($academic_year->id); ?>"><?php echo e($academic_year->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-lg-4 form-group">
            <label for="end_date">Classe</label>
            <select name="classroom_sort[]" id="classroom_sort" class="form-control select2" multiple oninput="exportExcelByYearAndClass()">
                <?php $__currentLoopData = $classrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($classroom->id); ?>"><?php echo e($classroom->name); ?> <?php echo e($classroom->indicative ? ' ('.$classroom->indicative.')' : ''); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-lg-4 form-group">
            <a id="btn_generate_by_sort" class="btn btn-primary" style="position: absolute; bottom:0px; width:90%;"><i data-feather='download'></i> Exportation</a>
        </div>
    </div>
    <!--/ Line Chart Card -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts-page-vendor'); ?>
    <script src="<?php echo asset('/app-assets/vendors/js/charts/chart.min.js'); ?>"></script>
    <script src="<?php echo asset('/app-assets/vendors/js/charts/apexcharts.min.js'); ?>"></script>

    <script src="<?php echo asset('/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js'); ?>"></script>

    <script src="<?php echo asset('/app-assets/vendors/js/forms/select/select2.full.min.js'); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts-page'); ?>
    <script src="<?php echo asset('/app-assets/js/scripts/forms/form-select2.min.js'); ?>"></script>
    <script src="<?php echo asset('/app-assets/js/scripts/forms/pickers/form-pickers.min.js'); ?>"></script>

    <?php echo $__env->make('state.js.default_functions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\review\cspyramides\resources\views/state/index.blade.php ENDPATH**/ ?>