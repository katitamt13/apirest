<!DOCTYPE html>
<html>
<head>
  <title>Clientes</title>
</head>
<body>

<h1>Clientes</h1>
<button onclick="consultar()">Consultar Clientes</button>

<table border="1">
  <thead>
    <tr>
      <th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody id="tabla"></tbody>
</table>

<h2>Agregar Cliente</h2>
<form id="formCliente">
  <input name="nombre" placeholder="Nombre"><br>
  <input name="apellido" placeholder="Apellido"><br>
  <input name="email" type="email" placeholder="Email"><br>
  <input name="id_cliente" placeholder="ID Cliente"><br>
  <input name="llave_secreta" placeholder="Llave Secreta"><br>
  <button type="submit">Guardar</button>
</form>

<script>
// Ruta correcta para tu backend
const API = "http://localhost/apirest/index.php?ruta=clientes";

// CONSULTAR CLIENTES
function consultar() {
  fetch(API)
    .then(res => res.json())
    .then(data => {
      const tabla = document.getElementById("tabla");
      tabla.innerHTML = data.detalle.map(c => `
        <tr>
          <td>${c.id}</td>
          <td>${c.nombre}</td>
          <td>${c.apellido}</td>
          <td>${c.email}</td>
          <td><button onclick="eliminar(${c.id}, '${c.nombre} ${c.apellido}')">Eliminar</button></td>
        </tr>
      `).join('');
    })
    .catch(error => console.error("Error al consultar:", error));
}

// ELIMINAR CLIENTE
function eliminar(id, nombre) {
  if (confirm("¿Eliminar a " + nombre + "?")) {
    fetch(API + `&id=${id}`, {
      method: "DELETE"
    })
    .then(res => res.json())
    .then(() => consultar());
  }
}

// AGREGAR CLIENTE
document.getElementById("formCliente").addEventListener("submit", function(e) {
  e.preventDefault();
  const datos = Object.fromEntries(new FormData(this).entries());

  fetch(API, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(datos)
  })
  .then(res => res.json())
  .then(() => {
    this.reset();
    consultar();
  });
});
</script>

</body>
</html>

