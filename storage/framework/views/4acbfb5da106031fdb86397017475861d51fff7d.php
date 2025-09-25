

<?php $__env->startSection('title', 'Gestión de Proveedores'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/pages/proveedores.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-truck"></i> Gestión de Proveedores</h1>
    <a href="<?php echo e(route('proveedores.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Proveedor
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if($proveedores->count() > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Contacto</th>
                        <th>Total Compras</th>
                        <th>Insumos</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($proveedor->proveedor_id); ?></td>
                        <td>
                            <strong><?php echo e($proveedor->nombre); ?></strong>
                            <br>
                            <small class="text-muted"><?php echo e($proveedor->direccion); ?></small>
                        </td>
                        <td>
                            <i class="fas fa-phone"></i> <?php echo e($proveedor->telefono); ?><br>
                            <i class="fas fa-envelope"></i> <?php echo e($proveedor->correo); ?>

                        </td>
                        <td>$<?php echo e(number_format($proveedor->total_compras, 2)); ?></td>
                        <td>
                            <?php if($proveedor->insumos->count() > 0): ?>
                                <span class="badge bg-success"><?php echo e($proveedor->insumos->count()); ?> insumos</span>
                            <?php else: ?>
                                <span class="text-muted">Sin insumos</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($proveedor->estado == 'Activo' ? 'success' : 'secondary'); ?>">
                                <?php echo e($proveedor->estado); ?>

                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="<?php echo e(route('proveedores.show', $proveedor->proveedor_id)); ?>" class="btn btn-info btn-sm" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('proveedores.edit', $proveedor->proveedor_id)); ?>" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('proveedores.destroy', $proveedor->proveedor_id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" 
                                        onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">
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
            <i class="fas fa-truck fa-3x text-muted mb-3"></i>
            <h4>No hay proveedores registrados</h4>
            <p class="text-muted">Comienza agregando tu primer proveedor.</p>
            <a href="<?php echo e(route('proveedores.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Primer Proveedor
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\La-comarca-ADMIN\resources\views/proveedor/index.blade.php ENDPATH**/ ?>