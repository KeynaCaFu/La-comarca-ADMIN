

<?php $__env->startSection('title', 'Gestión de Insumos'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-boxes"></i> Gestión de Insumos</h1>
    <a href="<?php echo e(route('insumos.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Insumo
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if($insumos->count() > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Stock Actual</th>
                        <th>Stock Mínimo</th>
                        <th>Precio</th>
                        <th>Proveedores</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $insumos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insumo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($insumo->insumo_id); ?></td>
                        <td>
                            <strong><?php echo e($insumo->nombre); ?></strong>
                            <br>
                            <small class="text-muted"><?php echo e($insumo->unidad_medida); ?> - Cant: <?php echo e($insumo->cantidad); ?></small>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($insumo->stock_actual > $insumo->stock_minimo ? 'success' : 'warning'); ?>">
                                <?php echo e($insumo->stock_actual); ?>

                            </span>
                        </td>
                        <td><?php echo e($insumo->stock_minimo); ?></td>
                        <td>$<?php echo e(number_format($insumo->precio, 2)); ?></td>
                        <td>
                            <?php if($insumo->proveedores->count() > 0): ?>
                                <?php $__currentLoopData = $insumo->proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge bg-info"><?php echo e($proveedor->nombre); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <span class="text-muted">Sin proveedores</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($insumo->estado == 'Disponible' ? 'success' : ($insumo->estado == 'Agotado' ? 'danger' : 'secondary')); ?>">
                                <?php echo e($insumo->estado); ?>

                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="<?php echo e(route('insumos.show', $insumo->insumo_id)); ?>" class="btn btn-info btn-sm" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('insumos.edit', $insumo->insumo_id)); ?>" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('insumos.destroy', $insumo->insumo_id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" 
                                        onclick="return confirm('¿Estás seguro de eliminar este insumo?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
            <h4>No hay insumos registrados</h4>
            <p class="text-muted">Comienza agregando tu primer insumo.</p>
            <a href="<?php echo e(route('insumos.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Primer Insumo
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyectos 2025 U\La-comarca-ADMIN\resources\views/insumos/index.blade.php ENDPATH**/ ?>