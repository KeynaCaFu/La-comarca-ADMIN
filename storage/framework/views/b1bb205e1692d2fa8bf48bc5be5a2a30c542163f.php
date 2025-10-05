

<?php $__env->startSection('title', 'Bienvenido - La Comarca'); ?>

<?php $__env->startSection('content'); ?>
<div class="welcome-card">
    <div class="logo-icon">
        <i class="fas fa-utensils"></i>
    </div>
    
    <h1 class="welcome-title">¡Bienvenido!</h1>
    
    <p class="welcome-subtitle">
        Sistema de administración <strong>La Comarca</strong><br>
        Gestiona tu restaurante de manera eficiente y sencilla
    </p>
    
    <a href="<?php echo e(route('dashboard')); ?>" class="btn-gestionar">
        <i class="fas fa-home me-2"></i>
        Gestionar mi Local
    </a>
    
    <div class="feature-icons">
        <i class="fas fa-boxes" title="Insumos"></i>
        <i class="fas fa-truck" title="Proveedores"></i>
        <i class="fas fa-chart-line" title="Reportes"></i>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\La-comarca-ADMIN\resources\views/welcome.blade.php ENDPATH**/ ?>