<div class="form-group">
    <label>Nombre</label>
    <input type="text" name="nombre" class="form-control ct-input"
           value="{{ old('nombre', $trabajador->nombre ?? '') }}">
</div>

<div class="form-group">
    <label>Apellido</label>
    <input type="text" name="apellido" class="form-control ct-input"
           value="{{ old('apellido', $trabajador->apellido ?? '') }}">
</div>

<div class="form-group">
    <label>DNI</label>
    <input type="text" name="dni" class="form-control ct-input"
           value="{{ old('dni', $trabajador->dni ?? '') }}">
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control ct-input"
           value="{{ old('email', $trabajador->email ?? '') }}">
</div>

<div class="form-group">
    <label>Teléfono</label>
    <input type="text" name="telefono" class="form-control ct-input"
           value="{{ old('telefono', $trabajador->telefono ?? '') }}">
</div>

<div class="form-group">
    <label>Puesto</label>
    <input type="text" name="puesto" class="form-control ct-input"
           value="{{ old('puesto', $trabajador->puesto ?? '') }}">
</div>

<div class="form-group">
    <label>Salario por hora</label>
    <input type="number" step="0.01" name="salario_hora" class="form-control ct-input"
           value="{{ old('salario_hora', $trabajador->salario_hora ?? '') }}">
</div>
