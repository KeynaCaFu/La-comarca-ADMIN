

<?php $__env->startSection('title', 'Gestión de Proveedores'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/pages/proveedores.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/proveedor-modals.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-truck"></i> Gestión de Proveedores</h1>
    <button type="button" class="btn btn-add" onclick="openCreateProveedorModal()">
        <i class="fas fa-plus"></i> Nuevo Proveedor
    </button>
</div>

<div class="table-container">
    <?php if($proveedores->count() > 0): ?>
    <div class="table-responsive">
        <table class="table proveedores-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Contacto</th>
                    <th>Total Compras</th>
                    <th>Insumos</th>
                    <th>Estado</th>
                    <th class="accion">Acciones</th>
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
                    <td class="contacto-info">
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
                        <?php if($proveedor->estado == 'Activo'): ?>
                            <span class="estado-activo-badge"><?php echo e($proveedor->estado); ?></span>
                        <?php else: ?>
                            <span class="estado-inactivo-badge"><?php echo e($proveedor->estado); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="baction">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-info btn-sm" title="Ver" onclick="openShowProveedorModal(<?php echo e($proveedor->proveedor_id); ?>)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" title="Editar" onclick="openEditProveedorModal(<?php echo e($proveedor->proveedor_id); ?>)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="<?php echo e(route('proveedor.destroy', $proveedor->proveedor_id)); ?>" method="POST" class="d-inline">
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
        <button type="button" class="btn btn-primary" onclick="openCreateProveedorModal()">
            <i class="fas fa-plus"></i> Crear Primer Proveedor
        </button>
    </div>
    <?php endif; ?>
</div>

<!-- Modal para Ver Detalles de Proveedor -->
<div id="showProveedorModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-info-circle"></i> Detalles del Proveedor</h3>
            <span class="close" onclick="closeProveedorModal('showProveedorModal')">&times;</span>
        </div>
        <div class="modal-body" id="showProveedorModalContent">
            <!-- El contenido se cargará aquí dinámicamente -->
        </div>
    </div>
</div>

<!-- Modal para Crear Proveedor -->
<div id="createProveedorModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-plus"></i> Crear Nuevo Proveedor</h3>
            <span class="close" onclick="closeProveedorModal('createProveedorModal')">&times;</span>
        </div>
        <div class="modal-body">
            <form id="createProveedorForm" action="<?php echo e(route('proveedor.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <div class="mb-3">
                    <label for="create_proveedor_nombre" class="form-label">Nombre del Proveedor *</label>
                    <input type="text" class="form-control" id="create_proveedor_nombre" name="nombre" required placeholder="Ej: Distribuidora Alimentos Frescos">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_proveedor_telefono" class="form-label">Teléfono *</label>
                            <input type="text" class="form-control" id="create_proveedor_telefono" name="telefono" required placeholder="Ej: 3001234567">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_proveedor_correo" class="form-label">Correo Electrónico *</label>
                            <input type="email" class="form-control" id="create_proveedor_correo" name="correo" required placeholder="Ej: contacto@proveedor.com">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="create_proveedor_direccion" class="form-label">Dirección *</label>
                    <textarea class="form-control" id="create_proveedor_direccion" name="direccion" required placeholder="Ej: Calle 123 #45-67, Bogotá"></textarea>
                </div>

                <div class="section-divider"></div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_proveedor_total_compras" class="form-label">Total de Compras *</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control" id="create_proveedor_total_compras" name="total_compras" required value="0" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_proveedor_estado" class="form-label">Estado *</label>
                            <select class="form-select" id="create_proveedor_estado" name="estado" required>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>
                
                <div class="mb-3">
                    <label class="form-label">Insumos que Provee <span class="info-tooltip" data-tooltip="Seleccione los insumos que este proveedor puede suministrar">ℹ️</span></label>
                    <div class="border p-3 rounded" id="createProveedorInsumosList" style="background-color: white; border-radius: 10px; max-height: 200px; overflow-y: auto;">
                        <?php $__currentLoopData = $insumos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insumo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="insumos[]" value="<?php echo e($insumo->insumo_id); ?>" id="create_proveedor_insumo<?php echo e($insumo->insumo_id); ?>">
                            <label class="form-check-label" for="create_proveedor_insumo<?php echo e($insumo->insumo_id); ?>">
                                <strong><?php echo e($insumo->nombre); ?></strong> - $<?php echo e(number_format($insumo->precio, 2)); ?>

                                <br><small class="text-muted"><?php echo e($insumo->unidad_medida); ?> | Stock: <?php echo e($insumo->stock_actual); ?></small>
                            </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($insumos->count() == 0): ?>
                        <div class="text-center p-3">
                            <i class="fas fa-box-open fa-2x text-muted mb-2"></i>
                            <p class="text-muted">No hay insumos disponibles.</p>
                            <small>Puede crear insumos primero y luego asignarlos a este proveedor.</small>
                        </div>
                        <?php endif; ?>
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="fas fa-info-circle"></i> 
                        Puede seleccionar múltiples insumos que este proveedor puede suministrar
                    </small>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeProveedorModal('createProveedorModal')">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Proveedor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Proveedor -->
<div id="editProveedorModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> Editar Proveedor</h3>
            <span class="close" onclick="closeProveedorModal('editProveedorModal')">&times;</span>
        </div>
        <div class="modal-body" id="editProveedorModalContent">
            <!-- El contenido se cargará aquí dinámicamente -->
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/proveedor-modals.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyectos 2025 U\La-comarca-ADMIN\resources\views/proveedor/index.blade.php ENDPATH**/ ?>