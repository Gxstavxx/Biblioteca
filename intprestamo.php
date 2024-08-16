<?php
include "conexion.php";

// Obtener datos para los filtros
$clientesQuery = "SELECT id, CONCAT(nombres_cli, ' ', apellidos_cli) AS nombre_completo FROM Clientes";
$librosQuery = "SELECT id, nombre FROM Libros";
$fechasQuery = "SELECT DISTINCT fecha_prestamo FROM Prestamo ORDER BY fecha_prestamo DESC";

$clientesResult = $conn->query($clientesQuery);
$librosResult = $conn->query($librosQuery);
$fechasResult = $conn->query($fechasQuery);

// Variables de búsqueda iniciales
$searchCliente = isset($_GET['searchCliente']) ? $_GET['searchCliente'] : '';
$searchLibro = isset($_GET['searchLibro']) ? $_GET['searchLibro'] : '';
$searchFecha = isset($_GET['searchFecha']) ? $_GET['searchFecha'] : '';

// Realizar la consulta SQL con filtros de búsqueda
$query = "SELECT Prestamo.id, 
                 Clientes.nombres_cli, 
                 Clientes.apellidos_cli, 
                 Libros.nombre AS libro, 
                 Prestamo.fecha_prestamo, 
                 Prestamo.fecha_devolucion
          FROM Prestamo
          INNER JOIN Clientes ON Prestamo.fk_cliente = Clientes.id
          INNER JOIN Libros ON Prestamo.fk_libro = Libros.id
          WHERE Clientes.id LIKE ? 
          AND Libros.id LIKE ?
          AND Prestamo.fecha_prestamo LIKE ?";

$stmt = $conn->prepare($query);
$searchCliente = "%{$searchCliente}%";
$searchLibro = "%{$searchLibro}%";
$searchFecha = "%{$searchFecha}%";
$stmt->bind_param("sss", $searchCliente, $searchLibro, $searchFecha);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Préstamos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Préstamos Registrados</h2>
        
        <!-- Botón para registrar un nuevo préstamo -->
        <a href="forprestamo.php" class="btn btn-info mb-3">Registrar un Nuevo Préstamo</a>
        
        <!-- Botón de Regresar con el mismo estilo que los botones de acción -->
        <div class="btn-group btn-group-sm mb-3" role="group">
            <a href="interfaz_empleados.php" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i> Regresar</a>
        </div>
        
        <!-- Formulario de búsqueda -->
        <form method="get" class="mb-3">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="searchCliente">Cliente:</label>
                    <select id="searchCliente" name="searchCliente" class="form-control">
                        <option value="">Selecciona un cliente</option>
                        <?php while ($cliente = $clientesResult->fetch_assoc()): ?>
                            <option value="<?php echo $cliente['id']; ?>" <?php echo $searchCliente == $cliente['id'] ? 'selected' : ''; ?>>
                                <?php echo $cliente['nombre_completo']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="searchLibro">Libro:</label>
                    <select id="searchLibro" name="searchLibro" class="form-control">
                        <option value="">Selecciona un libro</option>
                        <?php while ($libro = $librosResult->fetch_assoc()): ?>
                            <option value="<?php echo $libro['id']; ?>" <?php echo $searchLibro == $libro['id'] ? 'selected' : ''; ?>>
                                <?php echo $libro['nombre']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="searchFecha">Fecha de Préstamo:</label>
                    <select id="searchFecha" name="searchFecha" class="form-control">
                        <option value="">Selecciona una fecha</option>
                        <?php while ($fecha = $fechasResult->fetch_assoc()): ?>
                            <option value="<?php echo $fecha['fecha_prestamo']; ?>" <?php echo $searchFecha == $fecha['fecha_prestamo'] ? 'selected' : ''; ?>>
                                <?php echo $fecha['fecha_prestamo']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            
            </div>
        </form>
        
        <!-- Tabla de resultados -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Libro</th>
                    <th>Fecha de Préstamo</th>
                    <th>Fecha de Devolución</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nombres_cli'] . ' ' . $row['apellidos_cli']; ?></td>
                        <td><?php echo $row['libro']; ?></td>
                        <td><?php echo $row['fecha_prestamo']; ?></td>
                        <td><?php echo $row['fecha_devolucion']; ?></td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay préstamos registrados</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
