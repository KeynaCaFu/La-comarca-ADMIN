

<?php $__env->startSection('title', 'Crear Nuevo Proveedor'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-plus"></i> Crear Nuevo Proveedor</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('proveedores.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Proveedor *</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required 
                               value="<?php echo e(old('nombre')); ?>" placeholder="Ej: Distribuidora Alimentos Frescos">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono *</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required 
                                       value="<?php echo e(old('telefono')); ?>" placeholder="Ej: 3001234567">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico *</label>
                                <input type="email" class="form-control" id="correo" name="correo" required 
                                       value="<?php echo e(old('correo')); ?>" placeholder="Ej: contacto@proveedor.com">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección *</label>
                        <textarea class="form-control" id="direccion" name="direccion" required 
                                  placeholder="Ej: Calle 123 #45-67, Bogotá"><?php echo e(old('direccion')); ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="total_compras" class="form-label">Total de Compras *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control" id="total_compras" name="total_compras" required 
                                           value="<?php echo e(old('total_compras', 0)); ?>" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado *</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="Activo" <?php echo e(old('estado') == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                                    <option value="Inactivo" <?php echo e(old('estado') == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Insumos que Provee</label>
                        <div class="border p-3 rounded">
                            <?php $__currentLoopData = $insumos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insumo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="insumos[]" 
                                       value="<?php echo e($insumo->insumo_id); ?>" id="insumo<?php echo e($insumo->insumo_id); ?>"
                                       <?php echo e(in_array($insumo->insumo_id, old('insumos', [])) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="insumo<?php echo e($insumo->insumo_id); ?>">
                                    <?php echo e($insumo->nombre); ?> - $<?php echo e(number_format($insumo->precio, 2)); ?>

                                </label>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($insumos->count() == 0): ?>
                            <p class="text-muted">No hay insumos disponibles. <a href="<?php echo e(route('insumos.create')); ?>">Crear insumo</a></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?php echo e(route('proveedores.index')); ?>" class="btn btn-secondary me-md-2">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Proveedor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyectos 2025 U\La-comarca-ADMIN\resources\views/proveedor/create.blade.php ENDPATH**/ ?>