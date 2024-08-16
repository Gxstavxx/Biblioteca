<?php
include "conexion.php";

// Verificar si se ha recibido el ID del libro
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del libro a partir del ID
    $query = "SELECT * FROM Libros WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el registro
    if ($result->num_rows > 0) {
        $libro = $result->fetch_assoc();
    } else {
        echo "Libro no encontrado.";
        exit;
    }
} else {
    echo "ID de libro no proporcionado.";
    exit;
}

// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];

    // Actualizar los datos en la base de datos
    $updateQuery = "UPDATE Libros SET nombre = ?, descripcion = ?, cantidad = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssii", $nombre, $descripcion, $cantidad, $id);

    if ($stmt->execute()) {
        echo "Libro actualizado exitosamente.";
        header("Location: intlibros.php"); // Redirigir después de la edición
        exit;
    } else {
        echo "Error al actualizar el libro: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Libro</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($libro['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($libro['descripcion']); ?>" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($libro['cantidad']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="intlibros.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
