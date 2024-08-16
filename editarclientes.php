<?php
include "conexion.php";

// Verificar si se ha recibido el ID del cliente
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del cliente a partir del ID
    $query = "SELECT * FROM Clientes WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el registro
    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
    } else {
        echo "Cliente no encontrado.";
        exit;
    }
} else {
    echo "ID de cliente no proporcionado.";
    exit;
}

// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres_cli = $_POST['nombres_cli'];
    $apellidos_cli = $_POST['apellidos_cli'];
    $edad = $_POST['edad'];
    $direccion = $_POST['direccion'];
    $tel = $_POST['tel'];
    $identificacion = $_POST['identificacion'];

    // Actualizar los datos en la base de datos
    $updateQuery = "UPDATE Clientes SET nombres_cli = ?, apellidos_cli = ?, edad = ?, direccion = ?, tel = ?, identificacion = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssisssi", $nombres_cli, $apellidos_cli, $edad, $direccion, $tel, $identificacion, $id);

    if ($stmt->execute()) {
        echo "Cliente actualizado exitosamente.";
        header("Location: intClientes.php"); // Redirigir después de la edición
        exit;
    } else {
        echo "Error al actualizar el cliente: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Cliente</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="nombres_cli">Nombres:</label>
                <input type="text" class="form-control" id="nombres_cli" name="nombres_cli" value="<?php echo htmlspecialchars($cliente['nombres_cli']); ?>" required>
            </div>
            <div class="form-group">
                <label for="apellidos_cli">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos_cli" name="apellidos_cli" value="<?php echo htmlspecialchars($cliente['apellidos_cli']); ?>" required>
            </div>
            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="date" class="form-control" id="edad" name="edad" value="<?php echo htmlspecialchars($cliente['edad']); ?>" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo htmlspecialchars($cliente['direccion']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tel">Teléfono:</label>
                <input type="text" class="form-control" id="tel" name="tel" value="<?php echo htmlspecialchars($cliente['tel']); ?>" required>
            </div>
            <div class="form-group">
                <label for="identificacion">Identificación:</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion" value="<?php echo htmlspecialchars($cliente['identificacion']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="intClientes.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
