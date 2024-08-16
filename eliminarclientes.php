<?php
include "conexion.php";

// Verificar si se ha recibido el ID del cliente
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el registro de la base de datos
    $query = "DELETE FROM Clientes WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Cliente eliminado exitosamente.";
        header("Location: interfaz_administrador.php"); // Redirigir después de la eliminación
        exit;
    } else {
        echo "Error al eliminar el cliente: " . $stmt->error;
    }
} else {
    echo "ID de cliente no proporcionado.";
}

$conn->close();
?>
