<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

    // Capturar datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $fecha = $_POST['fecha']; // Asegúrate de que este campo es la edad o la fecha de nacimiento
    $direccion = $_POST['direccion'];
    $tel = $_POST['telefono']; // Debería ser un campo de teléfono
    $identificacion = $_POST['identificacion'];
    $cargo = $_POST['cargo'];

    // Verificar si la identificación ya existe
    $check_sql = "SELECT * FROM empleados WHERE identificacion = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $identificacion);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // La identificación ya existe
        $errorMsg = "La identificación ya está registrada. Por favor, use otra.";
        include 'registro_form.php'; // Asegúrate de que este archivo contiene el formulario HTML
    } else {
        // Insertar nuevo registro en la tabla empleados
        $sql = "INSERT INTO empleados (nombres, apellidos, edad, direccion, tel, identificacion, Cargo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $nombres, $apellidos, $fecha, $direccion, $tel, $identificacion, $cargo);

        if ($stmt->execute()) {
            header('Location: intempleados.php'); // Redirigir a la interfaz principal después de un registro exitoso
            exit();
        } else {
            $errorMsg = "Error al registrar: " . $stmt->error;
            include 'forempleados.php'; // Mostrar el formulario con el mensaje de error
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>
