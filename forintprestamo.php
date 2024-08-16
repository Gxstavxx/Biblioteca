<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

    // Capturar datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Verificar si el nombre del libro ya existe en la tabla de libros
    $check_sql = "SELECT * FROM Libros WHERE nombre = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $nombre);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // El nombre del libro ya existe
        $errorMsg = "El nombre del libro ya está registrado. Por favor, use otro.";
        include 'forlibros.php'; // Asegúrate de que este archivo contiene el formulario HTML de libros
    } else {
        // Insertar nuevo registro en la tabla libros
        $sql = "INSERT INTO Libros (nombre, descripcion) 
                VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre, $descripcion);

        if ($stmt->execute()) {
            header('Location: intLibros.php'); // Redirigir a la interfaz principal después de un registro exitoso
            exit();
        } else {
            $errorMsg = "Error al registrar: " . $stmt->error;
            include 'forlibros.php'; // Mostrar el formulario con el mensaje de error
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>
