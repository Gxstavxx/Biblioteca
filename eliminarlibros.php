<?php
include "conexion.php";

// Verificar si se ha recibido el ID del libro
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el registro de la base de datos
    $query = "DELETE FROM Libros WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Libro eliminado exitosamente.";
        header("Location: interfaz_libros.php"); // Redirigir después de la eliminación
        exit;
    } else {
        echo "Error al eliminar el libro: " . $stmt->error;
    }
} else {
    echo "ID de libro no proporcionado.";
}

$conn->close();
?>
