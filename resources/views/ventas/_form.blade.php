<div class="mb-3">
    <label class="form-label">Mueble</label>
    <select name="mueble_id" id="mueble_id" class="form-select @error('mueble_id') is-invalid @enderror">
        <option value="">-- Seleccionar --</option>
        @foreach($muebles as $m)
            <option value="{{ $m->id }}"
                data-precio="{{ $m->precio }}"
                data-stock="{{ $m->stock }}"
                {{ old('mueble_id', $venta->mueble_id ?? '') == $m->id ? 'selected' : '' }}>
                {{ $m->nombre }} (Stock: {{ $m->stock }})
            </option>
        @endforeach
    </select>
    @error('mueble_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Cliente</label>
    <input type="text" name="cliente" class="form-control @error('cliente') is-invalid @enderror"
           value="{{ old('cliente', $venta->cliente ?? '') }}">
    @error('cliente') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" class="form-control @error('cantidad') is-invalid @enderror"
               value="{{ old('cantidad', $venta->cantidad ?? 1) }}">
        @error('cantidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Fecha de venta</label>
        <input type="date" name="fecha_venta" class="form-control @error('fecha_venta') is-invalid @enderror"
               value="{{ old('fecha_venta', $venta->fecha_venta ?? '') }}">
        @error('fecha_venta') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Total</label>
        <input type="number" step="0.01" name="total" id="total" class="form-control @error('total') is-invalid @enderror"
               value="{{ old('total', $venta->total ?? '') }}">
        @error('total') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const muebleSelect = document.getElementById('mueble_id');
    const cantidadInput = document.getElementById('cantidad');
    const totalInput = document.getElementById('total');

    function calcularTotal() {
        const opcionSeleccionada = muebleSelect.options[muebleSelect.selectedIndex];
        const precio = parseFloat(opcionSeleccionada?.dataset.precio) || 0;
        const stock = parseInt(opcionSeleccionada?.dataset.stock) || 0;
        const cantidad = parseFloat(cantidadInput.value) || 0;

        totalInput.value = (precio * cantidad).toFixed(2);

        if (cantidad > stock) {
            cantidadInput.setCustomValidity(`Solo hay ${stock} unidades disponibles`);
        } else {
            cantidadInput.setCustomValidity('');
        }
    }

    muebleSelect.addEventListener('change', calcularTotal);
    cantidadInput.addEventListener('input', calcularTotal);

    if (muebleSelect.value) {
        calcularTotal();
    }
});
</script>