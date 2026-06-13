<div class="mb-3">
    <label class="form-label">Número de tarjeta</label>
    <input type="text"
           name="numero_tarjeta"
           class="form-control"
           value="{{ old('numero_tarjeta') }}"
           inputmode="numeric"
           pattern="[0-9]{16}"
           minlength="16"
           maxlength="16"
           placeholder="16 números"
           title="Ingresá los 16 números de la tarjeta"
           required>
    <div class="form-text">Debe tener 16 números, sin espacios ni guiones.</div>
</div>

<div class="mb-3">
    <label class="form-label">Nombre en la tarjeta</label>
    <input type="text"
           name="nombre_tarjeta"
           class="form-control"
           value="{{ old('nombre_tarjeta') }}"
           pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+"
           placeholder="Como figura en la tarjeta"
           required>
</div>

<div class="mb-3">
    <label class="form-label">Vencimiento</label>
    <input type="text"
           name="vencimiento"
           class="form-control vencimiento-tarjeta"
           value="{{ old('vencimiento') }}"
           inputmode="numeric"
           pattern="(0[1-9]|1[0-2])/[0-9]{2}"
           maxlength="5"
           placeholder="MM/AA"
           title="Ingresá un mes válido entre 01 y 12, con formato MM/AA"
           required>
    <div class="form-text">Formato MM/AA. El mes debe ser entre 01 y 12.</div>
</div>

<div class="mt-3">
    <label class="form-label">CVV</label>
    <input type="text"
           name="cvv"
           class="form-control"
           value="{{ old('cvv') }}"
           inputmode="numeric"
           pattern="[0-9]{3,4}"
           maxlength="4"
           placeholder="3 o 4 números"
           required>
</div>
