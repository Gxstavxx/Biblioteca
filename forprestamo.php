<?php
include 'conexion.php';

// Obtener la lista de clientes
$clientesQuery = "SELECT id, nombres_cli, apellidos_cli FROM Clientes";
$clientesResult = $conn->query($clientesQuery);

// Obtener la lista de libros
$librosQuery = "SELECT id, nombre FROM Libros";
$librosResult = $conn->query($librosQuery);

// Verificar si hay un mensaje de error
$errorMsg = isset($_GET['error']) && $_GET['error'] === 'libro_prestado' ? 'El libro ya ha sido prestado.' : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Préstamo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-center">Registro de Préstamo</h3>
                
                <!-- Mostrar mensaje de error -->
                <?php if ($errorMsg): ?>
                    <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
                <?php endif; ?>

                <form action="forintprestamo.php" method="post">
                    <div class="form-group mb-3">
                        <label for="fk_cliente">Cliente</label>
                        <select name="fk_cliente" class="form-control" required>
                            <option value="">Seleccione un Cliente</option>
                            <?php while ($cliente = $clientesResult->fetch_assoc()) { ?>
                                <option value="<?php echo $cliente['id']; ?>">
                                    <?php echo $cliente['nombres_cli'] . ' ' . $cliente['apellidos_cli']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="fk_libro">Libro</label>
                        <select name="fk_libro" class="form-control" required>
                            <option value="">Seleccione un Libro</option>
                            <?php while ($libro = $librosResult->fetch_assoc()) { ?>
                                <option value="<?php echo $libro['id']; ?>">
                                    <?php echo $libro['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="fecha_prestamo">Fecha de Préstamo</label>
                        <input type="date" name="fecha_prestamo" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="fecha_devolucion">Fecha de Devolución</label>
                        <input type="date" name="fecha_devolucion" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Registrar Préstamo</button>
                </form>
                <a href="intPrestamo.php" class="btn btn-secondary btn-block mt-2">Regresar</a>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
