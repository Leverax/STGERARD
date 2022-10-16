<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0"><?php echo e($title_page); ?></h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">

              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Tableau de bord</a></li>
              
              <?php if(isset($breadcrumbs)): ?>
                <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="breadcrumb-item"><a href="<?php echo e($breadcrumb[0]); ?>"> <?php echo e($breadcrumb[1]); ?> </a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
              

              <li class="breadcrumb-item active"><?php echo e($title_page); ?></li>

            </ol>
          </div>
        </div>
      </div>
    </div>
    
</div><?php /**PATH C:\xampp\htdocs\csiledesroses\resources\views/components/breadcrumbs.blade.php ENDPATH**/ ?>