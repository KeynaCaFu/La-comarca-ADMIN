<form id="editForm" action="<?php echo e(route('insumos.update', $insumo->insumo_id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="edit_nombre" class="form-label">Nombre del Insumo *</label>
                <input type="text" class="form-control" id="edit_nombre" name="nombre" required value="<?php echo e($insumo->nombre); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="edit_unidad_medida" class="form-label">Unidad de Medida *</label>
                <input type="text" class="form-control" id="edit_unidad_medida" name="unidad_medida" required value="<?php echo e($insumo->unidad_medida); ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="edit_stock_actual" class="form-label">Stock Actual *</label>
                <input type="number" class="form-control" id="edit_stock_actual" name="stock_actual" required value="<?php echo e($insumo->stock_actual); ?>" min="0">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="edit_stock_minimo" class="form-label">Stock Mínimo *</label>
                <input type="number" class="form-control" id="edit_stock_minimo" name="stock_minimo" required value="<?php echo e($insumo->stock_minimo); ?>" min="0">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="edit_cantidad" class="form-label">Cantidad *</label>
                <input type="number" class="form-control" id="edit_cantidad" name="cantidad" required value="<?php echo e($insumo->cantidad); ?>" min="1">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="edit_precio" class="form-label">Precio *</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" step="0.01" class="form-control" id="edit_precio" name="precio" required value="<?php echo e($insumo->precio); ?>" min="0">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="edit_fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                <input type="date" class="form-control" id="edit_fecha_vencimiento" name="fecha_vencimiento" value="<?php echo e($insumo->fecha_vencimiento ? $insumo->fecha_vencimiento->format('Y-m-d') : ''); ?>">
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="edit_estado" class="form-label">Estado *</label>
        <select class="form-select" id="edit_estado" name="estado" required>
            <option value="Disponible" <?php echo e($insumo->estado == 'Disponible' ? 'selected' : ''); ?>>Disponible</option>
            <option value="Agotado" <?php echo e($insumo->estado == 'Agotado' ? 'selected' : ''); ?>>Agotado</option>
            <option value="Vencido" <?php echo e($insumo->estado == 'Vencido' ? 'selected' : ''); ?>>Vencido</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Proveedores</label>
        <div class="border p-3 rounded" style="background-color: white; border-radius: 10px;">
            <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="proveedores[]" value="<?php echo e($proveedor->proveedor_id); ?>" id="edit_proveedor<?php echo e($proveedor->proveedor_id); ?>"
                       <?php echo e(in_array($proveedor->proveedor_id, $insumo->proveedores->pluck('proveedor_id')->toArray()) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="edit_proveedor<?php echo e($proveedor->proveedor_id); ?>">
                    <?php echo e($proveedor->nombre); ?> - <?php echo e($proveedor->telefono); ?>

                </label>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($proveedores->count() == 0): ?>
            <p class="text-muted">No hay proveedores activos.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal-actions">
        <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">
            <i class="fas fa-times"></i> Cancelar
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Actualizar Insumo
        </button>
    </div>
</form><?php /**PATH C:\xampp\htdocs\Proyectos 2025 U\La-comarca-ADMIN\resources\views/insumos/partials/edit-modal.blade.php ENDPATH**/ ?>