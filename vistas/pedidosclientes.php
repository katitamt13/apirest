
<?php /* pedidosclientes.php */ ?>
<!DOCTYPE html>
<html>
<head><title>Pedidos</title></head>
<body>
<h1>Pedidos</h1>
<button onclick="consultar()">Consultar Pedidos</button>
<table border="1">
<thead><tr><th>ID</th><th>ID Cliente</th><th>Estado</th><th>Precio</th><th>Acciones</th></tr></thead>
<tbody id="tabla"></tbody>
</table>
<h2>Agregar Pedido</h2>
<form id="formPedido">
  <input name="id_pedido" type="number" placeholder="ID Pedido"><br>
  <input name="id_cliente" type="number" placeholder="ID Cliente"><br>
  <input name="id_metodopago_cliente" type="number" placeholder="ID Método Pago"><br>
  <input name="codigo_estado_pedido" placeholder="Estado"><br>
  <input name="fecha_pedido" type="date"><br>
  <input name="fecha_pago" type="date"><br>
  <input name="precio_total_pedido" type="number" step="0.01" placeholder="Precio"><br>
  <input name="otros_detalles_pedido" placeholder="Detalles"><br>
  <button type="submit">Guardar</button>
</form>
<script>
const API = "http://localhost/apirest/index.php?ruta=pedidosclientes";
function consultar() {
  fetch(API)
    .then(r => r.json())
    .then(d => {
      tabla.innerHTML = d.detalle.map(p => `
        <tr>
          <td>${p.id_pedido}</td>
          <td>${p.id_cliente}</td>
          <td>${p.codigo_estado_pedido}</td>
          <td>${p.precio_total_pedido}</td>
          <td><button onclick="eliminar(${p.id_pedido}, '${p.codigo_estado_pedido}')">Eliminar</button></td>
        </tr>`).join('');
    });
}
function eliminar(id, estado) {
  if (confirm('¿Eliminar pedido en estado "' + estado + '"?')) {
    fetch(`${API}&id=${id}`, { method: 'DELETE' })
      .then(() => consultar());
  }
}
formPedido.onsubmit = e => {
  e.preventDefault();
  fetch(API, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(Object.fromEntries(new FormData(formPedido)))
  }).then(() => { formPedido.reset(); consultar(); });
};
</script>
</body></html>
