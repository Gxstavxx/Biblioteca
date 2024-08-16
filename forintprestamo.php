<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fk_cliente = $_POST['fk_cliente'];
    $fk_libro = $_POST['fk_libro'];
    $fecha_prestamo = $_POST['fecha_prestamo'];
    $fecha_devolucion = $_POST['fecha_devolucion'];

    // Verificar la cantidad disponible del libro seleccionado
    $cantidadQuery = "SELECT cantidad FROM Libros WHERE id = ?";
    $stmt = $conn->prepare($cantidadQuery);
    $stmt->bind_param("i", $fk_libro);
    $stmt->execute();
    $stmt->bind_result($cantidad);
    $stmt->fetch();
    $stmt->close();

    if ($cantidad > 0) {
        // La cantidad es mayor que 0, registrar el préstamo y actualizar la cantidad
        $insertQuery = "INSERT INTO prestamo (fk_cliente, fk_libro, fecha_prestamo, fecha_devolucion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("iiss", $fk_cliente, $fk_libro, $fecha_prestamo, $fecha_devolucion);

        if ($stmt->execute()) {
            // Actualizar la cantidad del libro
            $updateQuery = "UPDATE Libros SET cantidad = cantidad - 1 WHERE id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("i", $fk_libro);
            $stmt->execute();
            $stmt->close();

            header('Location: intPrestamo.php'); // Redirigir a la interfaz principal después de un registro exitoso
            exit();
        } else {
            $errorMsg = "Error al registrar el préstamo: " . $stmt->error;
            header("Location: registrarPrestamo.php?error=error_registro");
            exit();
        }
    } else {
        // La cantidad es 0, redirigir al formulario con un mensaje de error
        header("Location: registrarPrestamo.php?error=libro_no_disponible");
        exit();
    }

    $conn->close();
}
?>
