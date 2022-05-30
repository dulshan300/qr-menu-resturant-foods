<nav id="navbar-main" class="navbar navbar-top navbar-horizontal navbar-expand-md bg-white navbar-dark">

  <?php if(config('app.isqrsaas') && config('settings.disable_landing')): ?>
  
  <!-- Big Screen with buttton-->
 <div class="container-fluid px-7 d-none d-lg-flex d-lx-flex">
      <a class="navbar-brand" href="/">
        <img src="<?php echo e(config('global.site_logo')); ?>" />
      </a>
      <!--<div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">-->
      <?php if(config('app.isqrsaas') && config('settings.disable_landing')): ?>
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item ml-lg-4">
            <a href="<?php echo e(route('newrestaurant.register')); ?>" target="_blank" class="btn btn-neutral btn-icon">
              <span class="btn-inner--icon">
                <i class="fas fa-paper-plane mr-2"></i>
              </span>
              <span class="nav-link-inner--text"><?php echo e(__('Register')); ?></span>
            </a>
          </li>
        </ul>
      <?php endif; ?>
    </div>
    
    <!-- Small Screen with button-->
    <div class="container-fluid d-flex d-md-flex d-lg-none d-lx-none px-2">
      <a class="navbar-brand" href="/">
        <img src="<?php echo e(config('global.site_logo')); ?>" />
      </a>
      <!--<div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">-->
      <?php if(config('app.isqrsaas') && config('settings.disable_landing')): ?>
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item ml-lg-4">
            <a href="<?php echo e(route('newrestaurant.register')); ?>" target="_blank" class="btn btn-neutral btn-icon">
              <span class="btn-inner--icon">
                <i class="fas fa-paper-plane mr-2"></i>
              </span>
              <span class="nav-link-inner--text"><?php echo e(__('Register')); ?></span>
            </a>
          </li>
        </ul>
      <?php endif; ?>
    </div>
    


  <?php else: ?>
    <!-- Big Screen just logo -->
    <div class="container-fluid px-7 d-none d-md-none d-lg-block d-lx-block">
      <a class="navbar-brand" href="/">
        <img src="<?php echo e(config('global.site_logo')); ?>" />
      </a>
    </div>

    <!-- Small Screen just logo -->
    <div class="text-center w-100 d-block d-md-block d-lg-none d-lx-none">
        <a class="navbar-brand" href="/">
          <img src="<?php echo e(config('global.site_logo')); ?>" />
        </a>
    </div>
 <?php endif; ?>
  

</nav>
<?php /**PATH E:\FDM Downloads\2022-05-30\codecanyon-JLlN8pi2-qr-menu-maker-saas-contactless-restaurant-menus\resources\views/layouts/navbars/navs/guest.blade.php ENDPATH**/ ?>