<div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
           value="{{ old('nombre', $mueble->nombre ?? '') }}">
    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Descripción</label>
    <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $mueble->descripcion ?? '') }}</textarea>
    @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Precio</label>
        <input type="number" step="0.01" name="precio" class="form-control @error('precio') is-invalid @enderror"
               value="{{ old('precio', $mueble->precio ?? '') }}">
        @error('precio') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
               value="{{ old('stock', $mueble->stock ?? 0) }}">
        @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Categoría</label>
        <input type="text" name="categoria" class="form-control @error('categoria') is-invalid @enderror"
               value="{{ old('categoria', $mueble->categoria ?? '') }}">
        @error('categoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>