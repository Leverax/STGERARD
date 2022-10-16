    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
        <div class="navbar-container d-flex content">
          <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
              <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
          </div>
          <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown dropdown-user">
              <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="user-nav d-sm-flex d-none">
                    <span class="user-name font-weight-bolder"> <?php echo Auth::user()->lastname.' '.Auth::user()->firstname; ?> </span>
                    <span class="user-status"><?php echo Auth::user()->status == 'admin' ? 'Administrateur' : 'Utilisateur'; ?></span>
                </div>
                <span class="avatar bg-white">
                    <img class="round" src="<?php echo asset('images/avatar.png'); ?>" alt="avatar" height="40" width="40">
                    <span class="avatar-status-online"></span>
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                
                
                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"><i class="mr-50" data-feather="power"></i> Déconnexion</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      
      <!-- END: Header--><?php /**PATH C:\xampp\htdocs\csiledesroses\resources\views/layouts/header.blade.php ENDPATH**/ ?>