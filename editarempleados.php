<?php
include "conexion.php";

// Verificar si se ha recibido el ID del empleado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del empleado a partir del ID
    $query = "SELECT * FROM empleados WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el registro
    if ($result->num_rows > 0) {
        $empleado = $result->fetch_assoc();
    } else {
        echo "Empleado no encontrado.";
        exit;
    }
} else {
    echo "ID de empleado no proporcionado.";
    exit;
}

// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $direccion = $_POST['direccion'];
    $tel = $_POST['tel'];
    $identificacion = $_POST['identificacion'];
    $cargo = $_POST['cargo'];

    // Actualizar los datos en la base de datos
    $updateQuery = "UPDATE empleados SET nombres = ?, apellidos = ?, edad = ?, direccion = ?, tel = ?, identificacion = ?, cargo = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssissssi", $nombres, $apellidos, $edad, $direccion, $tel, $identificacion, $cargo, $id);

    if ($stmt->execute()) {
        echo "Empleado actualizado exitosamente.";
        header("Location: intempleados.php"); // Redirigir después de la edición
        exit;
    } else {
        echo "Error al actualizar el empleado: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Empleado</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $empleado['nombres']; ?>" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $empleado['apellidos']; ?>" required>
            </div>
            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="date" class="form-control" id="edad" name="edad" value="<?php echo $empleado['edad']; ?>" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $empleado['direccion']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tel">Teléfono:</label>
                <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $empleado['tel']; ?>" required>
            </div>
            <div class="form-group">
                <label for="identificacion">Identificación:</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion" value="<?php echo $empleado['identificacion']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cargo">Cargo:</label>
                <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo $empleado['Cargo']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="intempleados.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
