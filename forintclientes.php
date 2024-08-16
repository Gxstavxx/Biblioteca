<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

    // Capturar datos del formulario
    $nombres_cli = $_POST['nombres_cli'];
    $apellidos_cli = $_POST['apellidos_cli'];
    $edad = $_POST['edad'];
    $direccion = $_POST['direccion'];
    $tel = $_POST['tel'];
    $identificacion = $_POST['identificacion'];

    // Verificar si la identificación ya existe en la tabla de clientes
    $check_sql = "SELECT * FROM Clientes WHERE identificacion = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $identificacion);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // La identificación ya existe
        $errorMsg = "La identificación ya está registrada. Por favor, use otra.";
        include 'forclientes.php'; // Asegúrate de que este archivo contiene el formulario HTML de clientes
    } else {
        // Insertar nuevo registro en la tabla clientes
        $sql = "INSERT INTO Clientes (nombres_cli, apellidos_cli, edad, direccion, tel, identificacion) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $nombres_cli, $apellidos_cli, $edad, $direccion, $tel, $identificacion);

        if ($stmt->execute()) {
            header('Location: intClientes.php'); // Redirigir a la interfaz principal después de un registro exitoso
            exit();
        } else {
            $errorMsg = "Error al registrar: " . $stmt->error;
            include 'forclientes.php'; // Mostrar el formulario con el mensaje de error
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>
