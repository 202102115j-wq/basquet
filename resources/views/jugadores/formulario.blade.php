<div class="field"><label>Nombre</label><input name="nombre" value="{{ old('nombre', $jugador->nombre ?? '') }}" required></div>
<div class="field"><label>Apellido</label><input name="apellido" value="{{ old('apellido', $jugador->apellido ?? '') }}" required></div>
<div class="field"><label>Dorsal (0-99)</label><input type="number" min="0" max="99" name="dorsal" value="{{ old('dorsal', $jugador->dorsal ?? '') }}"></div>
<div class="field"><label>Posición</label><select name="posicion"><option value="">-- Seleccionar --</option>@foreach (['Base','Escolta','Alero','Ala-pivot','Pivot'] as $pos)<option value="{{ $pos }}" @selected(old('posicion', $jugador->posicion ?? '') === $pos)>{{ $pos }}</option>@endforeach</select></div>
