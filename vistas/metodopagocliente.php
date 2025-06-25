<?php /* metodospagoclientes.php */ ?>
<!DOCTYPE html>
<html>
<head><title>Métodos de Pago</title></head>
<body>
<h1>Métodos de Pago</h1>
<button onclick="consultar()">Consultar Métodos</button>
<table border="1">
<thead><tr><th>ID</th><th>ID Cliente</th><th>Código</th><th>Tarjeta</th><th>Acciones</th></tr></thead>
<tbody id="tabla"></tbody>
</table>
<h2>Agregar Método de Pago</h2>
<form id="formMetodo">
  <input name="id_metodopago_cliente" type="number" placeholder="ID Método"><br>
  <input name="id_cliente" type="number" placeholder="ID Cliente"><br>
  <input name="codigo_metodo_pago" placeholder="Código"><br>
  <input name="numero_tarjeta" placeholder="Tarjeta"><br>
  <input name="fecha_inicio" type="date"><br>
  <input name="fecha_fin" type="date"><br>
  <input name="otros_detalles" placeholder="Detalles"><br>
  <button type="submit">Guardar</button>
</form>
<script>
const API = "http://localhost/apirest/index.php?ruta=metodospagoclientes";
function consultar() {
  fetch(API)
    .then(r => r.json())
    .then(d => {
      tabla.innerHTML = d.detalle.map(m => `
        <tr>
          <td>${m.id_metodopago_cliente}</td>
          <td>${m.id_cliente}</td>
          <td>${m.codigo_metodo_pago}</td>
          <td>${m.numero_tarjeta}</td>
          <td><button onclick="eliminar(${m.id_metodopago_cliente}, '${m.codigo_metodo_pago}')">Eliminar</button></td>
        </tr>`).join('');
    });
}
function eliminar(id, cod) {
  if (confirm('¿Eliminar método "' + cod + '"?')) {
    fetch(`${API}&id=${id}`, { method: 'DELETE' })
      .then(() => consultar());
  }
}
formMetodo.onsubmit = e => {
  e.preventDefault();
  fetch(API, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(Object.fromEntries(new FormData(formMetodo)))
  }).then(() => { formMetodo.reset(); consultar(); });
};
</script>
</body></html>