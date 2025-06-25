<?php /* cursos.php */ ?>
<!DOCTYPE html>
<html>
<head><title>Cursos</title></head>
<body>
<h1>Cursos</h1>
<button onclick="consultar()">Consultar Cursos</button>
<table border="1">
<thead><tr><th>ID</th><th>Título</th><th>Instructor</th><th>Precio</th><th>Acciones</th></tr></thead>
<tbody id="tabla"></tbody>
</table>
<h2>Agregar Curso</h2>
<form id="formCurso">
  <input name="titulo" placeholder="Título"><br>
  <input name="descripcion" placeholder="Descripción"><br>
  <input name="instructor" placeholder="Instructor"><br>
  <input name="imagen" placeholder="Imagen"><br>
  <input name="precio" type="number" placeholder="Precio"><br>
  <input name="id_creador" type="number" placeholder="ID Creador"><br>
  <button type="submit">Guardar</button>
</form>
<script>
const API = "http://localhost/apirest/index.php?ruta=cursos";
function consultar() {
  fetch(API)
    .then(r => r.json())
    .then(d => {
      tabla.innerHTML = d.detalle.map(c => `
        <tr>
          <td>${c.id}</td>
          <td>${c.titulo}</td>
          <td>${c.instructor}</td>
          <td>${c.precio}</td>
          <td>
            <button onclick="eliminar(${c.id}, '${c.titulo}')">Eliminar</button>
          </td>
        </tr>`).join('');
    });
}
function eliminar(id, titulo) {
  if (confirm('¿Eliminar curso "' + titulo + '"?')) {
    fetch(`${API}&id=${id}`, { method: 'DELETE' })
      .then(() => consultar());
  }
}
formCurso.onsubmit = e => {
  e.preventDefault();
  fetch(API, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(Object.fromEntries(new FormData(formCurso)))
  }).then(() => { formCurso.reset(); consultar(); });
};
</script>
</body></html>
