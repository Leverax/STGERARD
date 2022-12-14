
    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header mb-3">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <h2 class="brand-text">
                  <img class="" src="<?php echo asset('/images/logo.png'); ?>" alt="Logo CS Les Pyramides" width="100">
                </h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
          </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
          <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

              <li class="nav-item <?php echo e(Route::currentRouteName() == 'home' ? 'active' : ''); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('home')); ?>">
                  <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Tableau de bord</span>
                </a>
              </li>

              <li class=" navigation-header"><span data-i18n=""></span><i data-feather="more-horizontal"></i></li>

              <li class=" nav-item <?php echo e(Route::currentRouteName() == 'classroom.index' ? 'active' : ''); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('classroom.index')); ?>">
                  <i data-feather='layers'></i><span class="menu-title text-truncate" data-i18n="Classes">Classes</span>
                </a>
              </li>

              <li class=" nav-item <?php echo e(Route::currentRouteName() == 'student.index' ? 'active' : ''); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('student.index')); ?>">
                  <i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Inscrits">Inscrits</span>
                </a>
              </li>

              <?php if(Auth::user()->status == 'admin'): ?>
                <li class=" nav-item <?php echo e(Route::currentRouteName() == 'academic_year.index' ? 'active' : ''); ?>">
                  <a class="d-flex align-items-center" href="<?php echo e(route('academic_year.index')); ?>">
                    <i data-feather='calendar'></i><span class="menu-title text-truncate" data-i18n="Inscrits">Ann??e Acad??mique</span>
                  </a>
                </li>
              <?php endif; ?>

              <li class=" nav-item <?php echo e(Route::currentRouteName() == 'schooling.index' ? 'active' : ''); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('schooling.index')); ?>">
                  <i data-feather='file-text'></i><span class="menu-title text-truncate" data-i18n="Scolarit??s">Scolarit??s</span>
                </a>
              </li>

             

              <?php if(Auth::user()->status == 'admin'): ?>
                <li class=" nav-item <?php echo e(Route::currentRouteName() == 'etat.index' ? 'active' : ''); ?>">
                  <a class="d-flex align-items-center" href="<?php echo e(route('etat.index')); ?>">
                    <i data-feather='bar-chart-2'></i><span class="menu-title text-truncate" data-i18n="Etats">Etats</span>
                  </a>
                </li>

                <li class=" nav-item <?php echo e(Route::currentRouteName() == 'utilisateur.index' ? 'active' : ''); ?>">
                  <a class="d-flex align-items-center" href="<?php echo e(route('utilisateur.index')); ?>">
                    <i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="Utilisateur">Utilisateurs</span>
                  </a>
                </li>
              <?php endif; ?>

            
          </ul>
        </div>
      </div>
      <!-- END: Main Menu--><?php /**PATH C:\wamp64\www\review\cspyramides\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>