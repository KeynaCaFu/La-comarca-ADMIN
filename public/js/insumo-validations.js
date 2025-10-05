class InsumoValidations {
    constructor() {
        this.initializeValidations();
    }

    initializeValidations() {
        // Validaciones en tiempo real
        this.setupRealtimeValidations();
        
        // Validaciones de formularios
        this.setupFormValidations();
    }

    setupRealtimeValidations() {
        // Validar stock vs estado
        document.addEventListener('change', (e) => {
            if (e.target.name === 'stock_actual' || e.target.name === 'estado') {
                this.validateStockVsEstado(e.target.form);
            }
        });

        // Validar fecha de vencimiento
        document.addEventListener('change', (e) => {
            if (e.target.name === 'fecha_vencimiento') {
                this.validateExpirationDate(e.target);
            }
        });

        // Validar precio
        document.addEventListener('input', (e) => {
            if (e.target.name === 'precio') {
                this.validatePrice(e.target);
            }
        });

        // Validar stock mínimo
        document.addEventListener('input', (e) => {
            if (e.target.name === 'stock_actual' || e.target.name === 'stock_minimo') {
                this.validateStockLevels(e.target.form);
            }
        });
    }

    setupFormValidations() {
        // Validar antes de enviar
        document.addEventListener('submit', (e) => {
            if (e.target.id === 'createForm' || e.target.id === 'editForm') {
                if (!this.validateForm(e.target)) {
                    e.preventDefault();
                }
            }
        });
    }

    validateForm(form) {
        let isValid = true;
        const errors = [];

        // Limpiar errores anteriores
        this.clearFormErrors(form);

        // Validar campos obligatorios
        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                this.showFieldError(field, 'Este campo es obligatorio');
                isValid = false;
            }
        });

        // Validaciones específicas
        if (!this.validateExpirationDate(form.querySelector('[name="fecha_vencimiento"]'))) {
            isValid = false;
        }

        if (!this.validateStockVsEstado(form)) {
            isValid = false;
        }

        if (!this.validatePrice(form.querySelector('[name="precio"]'))) {
            isValid = false;
        }

        if (!this.validateStockLevels(form)) {
            isValid = false;
        }

        // Mostrar resumen de errores si hay
        if (!isValid) {
            this.showValidationSummary(form, errors);
        }

        return isValid;
    }

    validateExpirationDate(dateInput) {
        if (!dateInput || !dateInput.value) return true;

        const selectedDate = new Date(dateInput.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate <= today) {
            this.showFieldError(dateInput, 'La fecha de vencimiento debe ser posterior a hoy');
            return false;
        }

        // Advertencia si vence pronto
        const daysUntilExpiry = Math.ceil((selectedDate - today) / (1000 * 60 * 60 * 24));
        if (daysUntilExpiry <= 7) {
            this.showFieldWarning(dateInput, `Advertencia: Este producto vence en ${daysUntilExpiry} días`);
        }

        this.clearFieldError(dateInput);
        return true;
    }

    validateStockVsEstado(form) {
        const stockActual = parseInt(form.querySelector('[name="stock_actual"]')?.value || 0);
        const estado = form.querySelector('[name="estado"]')?.value;

        if (stockActual === 0 && estado === 'Disponible') {
            this.showFormError(form, 'Un insumo sin stock no puede estar disponible');
            return false;
        }

        if (stockActual > 0 && estado === 'Agotado') {
            this.showFormError(form, 'Un insumo con stock no puede estar agotado');
            return false;
        }

        return true;
    }

    validatePrice(priceInput) {
        if (!priceInput || !priceInput.value) return true;

        const price = parseFloat(priceInput.value);

        if (price <= 0) {
            this.showFieldError(priceInput, 'El precio debe ser mayor a 0');
            return false;
        }

        if (price > 1000000) {
            this.showFieldWarning(priceInput, 'El precio parece muy alto, verifique que sea correcto');
        }

        this.clearFieldError(priceInput);
        return true;
    }

    validateStockLevels(form) {
        const stockActual = parseInt(form.querySelector('[name="stock_actual"]')?.value || 0);
        const stockMinimo = parseInt(form.querySelector('[name="stock_minimo"]')?.value || 0);

        if (stockActual < stockMinimo) {
            this.showFormWarning(form, 'El stock actual está por debajo del mínimo recomendado');
        }

        return true;
    }

    // Métodos de UI para mostrar errores
    showFieldError(field, message) {
        this.clearFieldError(field);
        field.classList.add('is-invalid');
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.textContent = message;
        field.parentNode.appendChild(errorDiv);
    }

    showFieldWarning(field, message) {
        this.clearFieldError(field);
        field.classList.add('is-warning');
        
        const warningDiv = document.createElement('div');
        warningDiv.className = 'warning-feedback';
        warningDiv.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`;
        field.parentNode.appendChild(warningDiv);
    }

    clearFieldError(field) {
        if (!field) return;
        
        field.classList.remove('is-invalid', 'is-warning');
        const feedback = field.parentNode.querySelector('.invalid-feedback, .warning-feedback');
        if (feedback) {
            feedback.remove();
        }
    }

    showFormError(form, message) {
        this.showNotification(message, 'error');
    }

    showFormWarning(form, message) {
        this.showNotification(message, 'warning');
    }

    clearFormErrors(form) {
        const invalidFields = form.querySelectorAll('.is-invalid, .is-warning');
        invalidFields.forEach(field => this.clearFieldError(field));
    }

    showNotification(message, type) {
        // Reutilizar la función de notificaciones existente
        if (typeof showNotification === 'function') {
            showNotification(message, type);
        } else {
            alert(message);
        }
    }
}

// Inicializar validaciones cuando se carga la página
document.addEventListener('DOMContentLoaded', function() {
    new InsumoValidations();
});