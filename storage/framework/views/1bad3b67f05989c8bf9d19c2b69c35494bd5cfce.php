<?php
// resources/views/insumos/partials/edit-modal.blade.php
?>
<div id="editErrors" class="alert alert-danger d-none">
    <ul class="mb-0" id="editErrorsList"></ul>
</div>

<form id="editForm" action="<?php echo e(route('insumos.update', $insumo->insumo_id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="edit_nombre" class="form-label">Nombre del Insumo *</label>
                <input type="text" class="form-control" id="edit_nombre" name="nombre" 
                       value="<?php echo e($insumo->nombre); ?>" required 
                       placeholder="Ej: Harina de Trigo" 
                       pattern="^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\-\.]+$"
                       title="Solo se permiten letras, espacios, guiones y puntos"
                       maxlength="255">
                <div class="invalid-feedback"></div>
                <small class="form-text text-muted">Solo letras, espacios, guiones y puntos</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="edit_unidad_medida" class="form-label">Unidad de Medida *</label>
                <select class="form-select" id="edit_unidad_medida" name="unidad_medida" required>
                    <option value="">Seleccionar unidad...</option>
                    <optgroup label="Peso">
                        <option value="kg" <?php echo e($insumo->unidad_medida == 'kg' ? 'selected' : ''); ?>>Kilogramos (kg)</option>
                        <option value="gramos" <?php echo e($insumo->unidad_medida == 'gramos' ? 'selected' : ''); ?>>Gramos (g)</option>
                    </optgroup>
                    <optgroup label="Volumen">
                        <option value="litros" <?php echo e($insumo->unidad_medida == 'litros' ? 'selected' : ''); ?>>Litros (L)</option>
                        <option value="ml" <?php echo e($insumo->unidad_medida == 'ml' ? 'selected' : ''); ?>>Mililitros (ml)</option>
                    </optgroup>
                    <optgroup label="Longitud">
                        <option value="metros" <?php echo e($insumo->unidad_medida == 'metros' ? 'selected' : ''); ?>>Metros (m)</option>
                        <option value="cm" <?php echo e($insumo->unidad_medida == 'cm' ? 'selected' : ''); ?>>Centímetros (cm)</option>
                    </optgroup>
                    <optgroup label="Cantidad">
                        <option value="unidades" <?php echo e($insumo->unidad_medida == 'unidades' ? 'selected' : ''); ?>>Unidades</option>
                        <option value="cajas" <?php echo e($insumo->unidad_medida == 'cajas' ? 'selected' : ''); ?>>Cajas</option>
                        <option value="bolsas" <?php echo e($insumo->unidad_medida == 'bolsas' ? 'selected' : ''); ?>>Bolsas</option>
                        <option value="botellas" <?php echo e($insumo->unidad_medida == 'botellas' ? 'selected' : ''); ?>>Botellas</option>
                        <option value="latas" <?php echo e($insumo->unidad_medida == 'latas' ? 'selected' : ''); ?>>Latas</option>
                        <option value="paquetes" <?php echo e($insumo->unidad_medida == 'paquetes' ? 'selected' : ''); ?>>Paquetes</option>
                    </optgroup>
                </select>
                <div class="invalid-feedback"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="edit_stock_actual" class="form-label">Stock Actual *</label>
                <input type="number" class="form-control" id="edit_stock_actual" name="stock_actual" 
                       value="<?php echo e($insumo->stock_actual); ?>" required min="0" max="999999" step="1"
                       title="Solo números enteros del 0 al 999,999">
                <div class="invalid-feedback"></div>
                <small class="form-text text-muted">Números enteros del 0 al 999,999</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="edit_stock_minimo" class="form-label">Stock Mínimo *</label>
                <input type="number" class="form-control" id="edit_stock_minimo" name="stock_minimo" 
                       value="<?php echo e($insumo->stock_minimo); ?>" required min="0" max="999999" step="1"
                       title="Solo números enteros del 0 al 999,999">
                <div class="invalid-feedback"></div>
                <small class="form-text text-muted">Números enteros del 0 al 999,999</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="edit_cantidad" class="form-label">Cantidad *</label>
                <input type="number" class="form-control" id="edit_cantidad" name="cantidad" 
                       value="<?php echo e($insumo->cantidad); ?>" required min="1" max="999999" step="1"
                       title="Solo números enteros del 1 al 999,999">
                <div class="invalid-feedback"></div>
                <small class="form-text text-muted">Números enteros del 1 al 999,999</small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="edit_precio" class="form-label">Precio *</label>
                <div class="input-group">
                    <span class="input-group-text">₡</span>
                    <input type="number" step="0.01" class="form-control" id="edit_precio" name="precio" 
                           value="<?php echo e($insumo->precio); ?>" required min="0.01" max="999999.99"
                           title="Precio válido entre ₡0.01 y ₡999,999.99">
                </div>
                <div class="invalid-feedback"></div>
                <small class="form-text text-muted">Precio entre ₡0.01 y ₡999,999.99</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="edit_fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                <input type="date" class="form-control" id="edit_fecha_vencimiento" name="fecha_vencimiento"
                       value="<?php echo e($insumo->fecha_vencimiento); ?>"
                       min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>"
                       title="La fecha debe ser posterior a hoy">
                <div class="invalid-feedback"></div>
                <small class="form-text text-muted">Opcional - debe ser posterior a hoy</small>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="edit_estado" class="form-label">Estado *</label>
        <select class="form-select" id="edit_estado" name="estado" required>
            <option value="">Seleccionar estado...</option>
            <option value="Disponible" <?php echo e($insumo->estado == 'Disponible' ? 'selected' : ''); ?>>✅ Disponible</option>
            <option value="Agotado" <?php echo e($insumo->estado == 'Agotado' ? 'selected' : ''); ?>>❌ Agotado</option>
            <option value="Vencido" <?php echo e($insumo->estado == 'Vencido' ? 'selected' : ''); ?>>💀 Vencido</option>
        </select>
        <div class="invalid-feedback"></div>
    </div>

    <div class="mb-3">
        <label class="form-label">Proveedores</label>
        <div class="border p-3 rounded">
            <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="proveedores[]" 
                       value="<?php echo e($proveedor->proveedor_id); ?>" 
                       id="edit_proveedor<?php echo e($proveedor->proveedor_id); ?>"
                       <?php echo e($insumo->proveedores->contains('proveedor_id', $proveedor->proveedor_id) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="edit_proveedor<?php echo e($proveedor->proveedor_id); ?>">
                    <?php echo e($proveedor->nombre); ?> - <?php echo e($proveedor->telefono); ?>

                </label>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($proveedores->count() == 0): ?>
            <p class="text-muted">No hay proveedores activos.</p>
            <?php endif; ?>
        </div>
        <small class="form-text text-muted">Selecciona uno o más proveedores (opcional)</small>
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