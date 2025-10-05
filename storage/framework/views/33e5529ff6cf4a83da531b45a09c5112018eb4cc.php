<div class="detail-section">
    <div class="row mb-4">
        <div class="col-md-8">
            <h4 style="color: #485a1a; margin-bottom: 5px;"><?php echo e($insumo->nombre); ?></h4>
            <p class="text-muted">ID: <?php echo e($insumo->insumo_id); ?></p>
        </div>
        <div class="col-md-4 text-end">
            <span class="status-badge status-<?php echo e(strtolower($insumo->estado)); ?>">
                <?php echo e($insumo->estado); ?>

            </span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h5>Información General</h5>
            <table class="detail-table">
                <tr>
                    <th>Unidad de Medida:</th>
                    <td><?php echo e($insumo->unidad_medida); ?></td>
                </tr>
                <tr>
                    <th>Cantidad:</th>
                    <td><?php echo e($insumo->cantidad); ?></td>
                </tr>
                <tr>
                    <th>Precio:</th>
                    <td>$<?php echo e(number_format($insumo->precio, 2)); ?></td>
                </tr>
                <tr>
                    <th>Fecha Vencimiento:</th>
                    <td><?php echo e($insumo->fecha_vencimiento ? $insumo->fecha_vencimiento->format('d/m/Y') : 'No especificada'); ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <h5>Inventario</h5>
            <table class="detail-table">
                <tr>
                    <th>Stock Actual:</th>
                    <td>
                        <span class="status-badge <?php echo e($insumo->stock_actual > $insumo->stock_minimo ? 'status-disponible' : 'status-agotado'); ?>">
                            <?php echo e($insumo->stock_actual); ?>

                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Stock Mínimo:</th>
                    <td><?php echo e($insumo->stock_minimo); ?></td>
                </tr>
                <tr>
                    <th>Diferencia:</th>
                    <td>
                        <span class="status-badge <?php echo e(($insumo->stock_actual - $insumo->stock_minimo) >= 0 ? 'status-disponible' : 'status-agotado'); ?>">
                            <?php echo e($insumo->stock_actual - $insumo->stock_minimo); ?>

                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <h5>Proveedores</h5>
        <?php if($insumo->proveedores->count() > 0): ?>
        <div class="row">
            <?php $__currentLoopData = $insumo->proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 mb-2">
                <div class="proveedor-card">
                    <h6><?php echo e($proveedor->nombre); ?></h6>
                    <p>
                        <i class="fas fa-phone"></i> <?php echo e($proveedor->telefono); ?><br>
                        <i class="fas fa-envelope"></i> <?php echo e($proveedor->correo); ?>

                    </p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div class="alert alert-warning" style="background-color: #fff3cd; border: 1px solid #ffecb5; color: #856404; padding: 15px; border-radius: 8px;">
            <i class="fas fa-exclamation-triangle"></i> Este insumo no tiene proveedores asignados.
        </div>
        <?php endif; ?>
    </div>

    <div class="modal-actions">
        <button type="button" class="btn btn-secondary" onclick="closeModal('showModal')">
            <i class="fas fa-times"></i> Cerrar
        </button>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Proyectos 2025 U\La-comarca-ADMIN\resources\views/insumos/partials/show-modal.blade.php ENDPATH**/ ?>