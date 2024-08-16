<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php';

    // Capturar datos del formulario
    $fk_cliente = $_POST['fk_cliente'];
    $fk_libro = $_POST['fk_libro'];
    $fecha_prestamo = $_POST['fecha_prestamo'];
    $fecha_devolucion = $_POST['fecha_devolucion'];

    // Verificar si el libro ya está prestado
    $verificarQuery = "SELECT * FROM Prestamo WHERE fk_libro = ? AND fecha_devolucion IS NULL";
    $stmt = $conn->prepare($verificarQuery);
    $stmt->bind_param("s", $fk_libro);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Libro ya prestado, redirigir con mensaje
        header('Location: forprestamo.php?error=libro_prestado');
        exit();
    } else {
        // Insertar nuevo registro en la tabla Prestamo
        $sql = "INSERT INTO Prestamo (fk_cliente, fk_libro, fecha_prestamo, fecha_devolucion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $fk_cliente, $fk_libro, $fecha_prestamo, $fecha_devolucion);

        if ($stmt->execute()) {
            header('Location: intprestamo.php'); // Redirigir a la interfaz principal después de un registro exitoso
            exit();
        } else {
            $errorMsg = "Error al registrar el préstamo: " . $stmt->error;
            include 'forprestamo.php'; // Mostrar el formulario con el mensaje de error
        }
    }

    $stmt->close();
    $conn->close();
}
?>
