<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php'; 

    $carrera = $_POST['carrera'];
    $descripcion = $_POST['descripcion'];

    // Verificar si la carrera ya existe
    $check_sql = "SELECT * FROM carrera WHERE carrera = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $carrera);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // La carrera ya existe
        $errorMsg = "La carrera ya existe. Por favor, elija otra.";
        include 'registroasignatura.php'; // Asegúrate de que 'registro_carrera.php' contiene el código HTML del formulario
    } else {
        // Insertar nuevo registro
        $sql = "INSERT INTO carrera (carrera, descripcion) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $carrera, $descripcion);

        if ($stmt->execute()) {
            header('Location: asignatura.php');
            exit(); // Asegurarse de que el script se detenga después de la redirección
        } else {
            $errorMsg = "Error al registrar: " . $stmt->error;
            include 'registro_carrera.php';
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>
