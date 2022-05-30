
<div class="row">
    <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xl-3 col-lg-6">
        <?php echo $__env->make('partials.infoboxes.box',$card, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH E:\FDM Downloads\2022-05-30\codecanyon-JLlN8pi2-qr-menu-maker-saas-contactless-restaurant-menus\resources\views/partials/infoboxes/index.blade.php ENDPATH**/ ?>