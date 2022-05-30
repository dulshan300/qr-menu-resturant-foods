<div class="row align-items-center" v-cloak>
    <div :class="item.pulse"></div>
    <div class="col ml--2">
        <small> {{ item.last_status }}</small><br />
        <small> {{ item.time }}</small>
        <h4 class="mb-0">
            <a href="#!">#{{ item.id }} {{ item.restaurant_name }}</a>
        </h4>
        <small>{{ item.client }}</small><br />
        <small>{{ item.price }}</small><br />
    </div>
    <div class="col-auto">
        <a class="btn btn-sm btn-primary" :href="item.link"><?php echo e(__('Details')); ?></a>
    </div>
  </div>
<?php /**PATH E:\FDM Downloads\2022-05-30\codecanyon-JLlN8pi2-qr-menu-maker-saas-contactless-restaurant-menus\resources\views/orders/partials/liveitem.blade.php ENDPATH**/ ?>