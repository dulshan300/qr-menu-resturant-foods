<ul class="navbar-nav">
    <?php if(config('app.ordering')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('home')); ?>">
                <i class="ni ni-tv-2 text-primary"></i> <?php echo e(__('Dashboard')); ?>

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/live">
                <i class="ni ni-basket text-success"></i> <?php echo e(__('Live Orders')); ?><div class="blob red"></div>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('orders.index')); ?>">
                <i class="ni ni-basket text-orangse"></i> <?php echo e(__('Orders')); ?>

            </a>
        </li>
    <?php endif; ?>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('admin.restaurants.edit',  auth()->user()->restorant->id)); ?>">
            <i class="ni ni-shop text-info"></i> <?php echo e(__('Restaurant')); ?>

        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('items.index')); ?>">
            <i class="ni ni-collection text-pink"></i> <?php echo e(__('Menu')); ?>

        </a>
    </li>

    <?php if(config('app.isqrsaas') && (!config('settings.qrsaas_disable_odering') || config('settings.enable_guest_log'))): ?>
        <?php if(!config('settings.is_whatsapp_ordering_mode') || in_array("poscloud", config('global.modules',[]))  || in_array("deliveryqr", config('global.modules',[])) ): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.restaurant.tables.index')); ?>">
                    <i class="ni ni-ungroup text-red"></i> <?php echo e(__('Tables')); ?>

                </a>
            </li>
        <?php endif; ?>
    <?php elseif(config('app.isft') && in_array("poscloud", config('global.modules',[])) ): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('admin.restaurant.tables.index')); ?>">
                <i class="ni ni-ungroup text-red"></i> <?php echo e(__('Tables')); ?>

            </a>
        </li>
    <?php endif; ?>

    <?php $__currentLoopData = auth()->user()->getExtraMenus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route($menu['route'],isset($menu['params'])?$menu['params']:[])); ?>">
                    <i class="<?php echo e($menu['icon']); ?>"></i> <?php echo e(__($menu['name'])); ?>

                </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    

    <?php if(config('app.isqrsaas')&&!config('settings.is_whatsapp_ordering_mode')&&!config('settings.is_pos_cloud_mode')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('qr')); ?>">
                <i class="ni ni-mobile-button text-red"></i> <?php echo e(__('QR Builder')); ?>

            </a>
        </li>
        <?php if(config('settings.enable_guest_log')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('admin.restaurant.visits.index')); ?>">
                <i class="ni ni-calendar-grid-58 text-blue"></i> <?php echo e(__('Customers log')); ?>

            </a>
        </li>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(config('app.isqrsaas')&&(config('settings.is_whatsapp_ordering_mode') || in_array("poscloud", config('global.modules',[]))  ||  in_array("deliveryqr", config('global.modules',[]))  )): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('admin.restaurant.simpledelivery.index')); ?>">
                <i class="ni ni-pin-3 text-blue"></i> <?php echo e(__('Delivery areas')); ?>

            </a>
        </li>
    <?php endif; ?>

    <?php if(config('settings.enable_pricing')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('plans.current')); ?>">
                <i class="ni ni-credit-card text-orange"></i> <?php echo e(__('Plan')); ?>

            </a>
        </li>
    <?php endif; ?>

        <?php if(config('app.ordering')&&config('settings.enable_finances_owner')): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('finances.owner')); ?>">
                    <i class="ni ni-money-coins text-blue"></i> <?php echo e(__('Finances')); ?>

                </a>
            </li>
        <?php endif; ?>

      
        <?php if( in_array("coupons", config('global.modules',[]))   ): ?>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.restaurant.coupons.index')); ?>">
                    <i class="ni ni-tag text-pink"></i> <?php echo e(__('Coupons')); ?>

                </a>
            </li>
        <?php endif; ?>


    <?php if(!config('settings.is_pos_cloud_mode')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('share.menu')); ?>">
                <i class="ni ni-send text-green"></i> <?php echo e(__('Share')); ?>

            </a>
        </li>
    <?php endif; ?>
    

</ul>
<?php /**PATH E:\FDM Downloads\2022-05-30\codecanyon-JLlN8pi2-qr-menu-maker-saas-contactless-restaurant-menus\resources\views/layouts/navbars/menus/owner.blade.php ENDPATH**/ ?>