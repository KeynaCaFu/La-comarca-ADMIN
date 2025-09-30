

<?php $__env->startSection('title', 'Detalles del Proveedor'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-info-circle"></i> Detalles del Proveedor</h3>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h4><?php echo e($proveedor->nombre); ?></h4>
                        <p class="text-muted">ID: <?php echo e($proveedor->proveedor_id); ?></p>
                    </div>
                    <div class="col-md-4 text-end">
                        <span class="badge bg-<?php echo e($proveedor->estado == 'Activo' ? 'success' : 'secondary'); ?> fs-6">
                            <?php echo e($proveedor->estado); ?>

                        </span>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Información de Contacto</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th><i class="fas fa-phone"></i> Teléfono:</th>
                                <td><?php echo e($proveedor->telefono); ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-envelope"></i> Correo:</th>
                                <td><?php echo e($proveedor->correo); ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-map-marker-alt"></i> Dirección:</th>
                                <td><?php echo e($proveedor->direccion); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Información Comercial</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Total Compras:</th>
                                <td>$<?php echo e(number_format($proveedor->total_compras, 2)); ?></td>
                            </tr>
                            <tr>
                                <th>Insumos Proveídos:</th>
                                <td>
                                    <span class="badge bg-success"><?php echo e($proveedor->insumos->count()); ?> insumos</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Estado:</th>
                                <td>
                                    <span class="badge bg-<?php echo e($proveedor->estado == 'Activo' ? 'success' : 'secondary'); ?>">
                                        <?php echo e($proveedor->estado); ?>

                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    <h5>Insumos que Provee</h5>
                    <?php if($proveedor->insumos->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Stock Actual</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $proveedor->insumos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insumo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($insumo->nombre); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($insumo->stock_actual > $insumo->stock_minimo ? 'success' : 'warning'); ?>">
                                            <?php echo e($insumo->stock_actual); ?>

                                        </span>
                                    </td>
                                    <td>$<?php echo e(number_format($insumo->precio, 2)); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($insumo->estado == 'Disponible' ? 'success' : ($insumo->estado == 'Agotado' ? 'danger' : 'secondary')); ?>">
                                            <?php echo e($insumo->estado); ?>

                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Este proveedor no tiene insumos asignados.
                    </div>
                    <?php endif; ?>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?php echo e(route('proveedores.index')); ?>" class="btn btn-secondary me-md-2">
                        <i class="fas fa-arrow-left"></i> Volver a la lista
                    </a>
                    <a href="<?php echo e(route('proveedores.edit', $proveedor->proveedor_id)); ?>" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Editar Proveedor
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\La-comarca-ADMIN\resources\views/proveedor/show.blade.php ENDPATH**/ ?>