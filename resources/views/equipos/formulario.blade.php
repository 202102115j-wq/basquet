<div class="field"><label>Nombre</label><input name="nombre" value="{{ old('nombre', $equipo->nombre ?? '') }}" required></div>
<div class="field"><label>Ciudad</label><input name="ciudad" value="{{ old('ciudad', $equipo->ciudad ?? '') }}" required></div>
<div class="field"><label>Entrenador</label><input name="entrenador" value="{{ old('entrenador', $equipo->entrenador ?? '') }}"></div>
