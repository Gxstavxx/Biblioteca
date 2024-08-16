<?php
include "conexion.php";

// Realizar la consulta SQL para obtener todos los préstamos
$query = "SELECT Prestamo.id, 
                 Clientes.nombres_cli, 
                 Clientes.apellidos_cli, 
                 Libros.nombre AS libro, 
                 Prestamo.fecha_prestamo, 
                 Prestamo.fecha_devolucion
          FROM Prestamo
          INNER JOIN Clientes ON Prestamo.fk_cliente = Clientes.id
          INNER JOIN Libros ON Prestamo.fk_libro = Libros.id";
$result = $conn->query($query);

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
            <a href="interfazprincipal.php" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i> Regresar</a>
        </div>
        
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
                        <td>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay préstamos registrados</td></tr>";
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
