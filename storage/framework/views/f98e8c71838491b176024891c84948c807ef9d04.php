

<?php $__env->startSection('title', 'Gestión de Insumos'); ?>

<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/validations.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-boxes"></i> Gestión de Insumos</h1>
    <button type="button" class="btn btn-primary" onclick="openCreateModal()">
        <i class="fas fa-plus"></i> Nuevo Insumo
    </button>
</div>

<!-- Alertas de validación automática -->
<?php if(session('warning')): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> <?php echo e(session('warning')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

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
                        <th>Vencimiento</th>
                        <th>Proveedores</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $insumos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insumo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="<?php echo e($insumo->estado == 'Vencido' ? 'table-danger' : ($insumo->stock_actual <= $insumo->stock_minimo ? 'table-warning' : '')); ?>">
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
                            <?php if($insumo->stock_actual <= $insumo->stock_minimo): ?>
                                <br><small class="text-warning"><i class="fas fa-exclamation-triangle"></i> Stock bajo</small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($insumo->stock_minimo); ?></td>
                        <td>$<?php echo e(number_format($insumo->precio, 2)); ?></td>
                        <td>
                            <?php if($insumo->fecha_vencimiento): ?>
                                <?php
                                    $fechaVencimiento = \Carbon\Carbon::parse($insumo->fecha_vencimiento);
                                    $diasRestantes = \Carbon\Carbon::now()->diffInDays($fechaVencimiento, false);
                                ?>
                                
                                <span class="badge bg-<?php echo e($diasRestantes < 0 ? 'danger' : ($diasRestantes <= 7 ? 'warning' : 'success')); ?>">
                                    <?php echo e($fechaVencimiento->format('d/m/Y')); ?>

                                </span>
                                
                                <?php if($diasRestantes < 0): ?>
                                    <br><small class="text-danger"><i class="fas fa-skull-crossbones"></i> Vencido</small>
                                <?php elseif($diasRestantes <= 7): ?>
                                    <br><small class="text-warning"><i class="fas fa-clock"></i> Vence en <?php echo e($diasRestantes); ?> días</small>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-muted">Sin fecha</span>
                            <?php endif; ?>
                        </td>
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
                                <button type="button" class="btn btn-info btn-sm" title="Ver" onclick="openShowModal(<?php echo e($insumo->insumo_id); ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" title="Editar" onclick="openEditModal(<?php echo e($insumo->insumo_id); ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
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
            <button type="button" class="btn btn-primary" onclick="openCreateModal()">
                <i class="fas fa-plus"></i> Crear Primer Insumo
            </button>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal para Ver Detalles -->
<div id="showModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-info-circle"></i> Detalles del Insumo</h3>
            <span class="close" onclick="closeModal('showModal')">&times;</span>
        </div>
        <div class="modal-body" id="showModalContent">
            <!-- El contenido se cargará aquí dinámicamente -->
        </div>
    </div>
</div>

<!-- Modal para Crear -->
<div id="createModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-plus"></i> Crear Nuevo Insumo</h3>
            <span class="close" onclick="closeModal('createModal')">&times;</span>
        </div>
        <div class="modal-body">
            <form id="createForm" action="<?php echo e(route('insumos.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_nombre" class="form-label">Nombre del Insumo *</label>
                            <input type="text" class="form-control" id="create_nombre" name="nombre" required placeholder="Ej: Harina de Trigo">
                            <div class="field-help">
                                <i class="fas fa-info-circle"></i> Debe ser único en el sistema
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_unidad_medida" class="form-label">Unidad de Medida *</label>
                            <input type="text" class="form-control" id="create_unidad_medida" name="unidad_medida" required placeholder="Ej: kg, litro, unidad">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="create_stock_actual" class="form-label">Stock Actual *</label>
                            <input type="number" class="form-control" id="create_stock_actual" name="stock_actual" required value="0" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="create_stock_minimo" class="form-label">Stock Mínimo *</label>
                            <input type="number" class="form-control" id="create_stock_minimo" name="stock_minimo" required value="0" min="0">
                            <div class="field-help">
                                <i class="fas fa-info-circle"></i> Límite para alertas de stock bajo
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="create_cantidad" class="form-label">Cantidad *</label>
                            <input type="number" class="form-control" id="create_cantidad" name="cantidad" required value="1" min="1">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_precio" class="form-label">Precio *</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control" id="create_precio" name="precio" required min="0.01" placeholder="0.00">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                            <input type="date" class="form-control" id="create_fecha_vencimiento" name="fecha_vencimiento">
                            <div class="field-help">
                                <i class="fas fa-info-circle"></i> Debe ser posterior a hoy
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="create_estado" class="form-label">Estado *</label>
                    <select class="form-select" id="create_estado" name="estado" required>
                        <option value="Disponible">Disponible</option>
                        <option value="Agotado">Agotado</option>
                        <option value="Vencido">Vencido</option>
                    </select>
                    <div class="field-help">
                        <i class="fas fa-info-circle"></i> Debe ser coherente con el stock actual
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Proveedores</label>
                    <div class="border p-3 rounded" id="createProveedoresList">
                        <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="proveedores[]" value="<?php echo e($proveedor->proveedor_id); ?>" id="create_proveedor<?php echo e($proveedor->proveedor_id); ?>">
                            <label class="form-check-label" for="create_proveedor<?php echo e($proveedor->proveedor_id); ?>">
                                <?php echo e($proveedor->nombre); ?> - <?php echo e($proveedor->telefono); ?>

                            </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($proveedores->count() == 0): ?>
                        <p class="text-muted">No hay proveedores activos.</p>
                        <?php endif; ?>
                    </div>
                    <div class="field-help">
                        <i class="fas fa-info-circle"></i> Recomendado para productos disponibles
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('createModal')">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Insumo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar -->
<div id="editModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> Editar Insumo</h3>
            <span class="close" onclick="closeModal('editModal')">&times;</span>
        </div>
        <div class="modal-body" id="editModalContent">
            <!-- El contenido se cargará aquí dinámicamente -->
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/insumo-modals.js')); ?>"></script>
<script src="<?php echo e(asset('js/insumo-validations.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyectos 2025 U\La-comarca-ADMIN\resources\views/insumos/index.blade.php ENDPATH**/ ?>