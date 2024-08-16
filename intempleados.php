<?php
include "conexion.php";

// Realizar la consulta SQL para obtener todos los registros
$query = "SELECT id, nombres, apellidos, edad, direccion, tel, identificacion, cargo  FROM empleados"; // Ajusta según la estructura de tu tabla
$result = $conn->query($query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz Administrador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            padding-top: 50px;
        }
        .btn-group .form-control {
            margin-left: 10px;
            width: 200px; /* Ajusta este valor según sea necesario */
        }
        .d-flex {
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-4">Registros de Empleados</h1>
                <a href="forempleados.php" class="btn btn-block btn-outline-info btn-sm">¿Deseas Registrar un Nuevo Empleado?</a>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="btn-group btn-group-sm" role="group">
                            </div>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="interfazprincipal.php" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Regresar</a>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">Edad</th>
                                    <th scope="col">Direccion</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Identificacion</th>
                                    <th scope="col">Cargo</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <?php
                                if ($result && $result->num_rows > 0) {
                                    while ($dat = $result->fetch_object()) {
                                ?>
                                    <tr data-nombres="<?php echo $dat->nombres; ?>" data-profesion="<?php echo $dat->profesion; ?>">
                                        <td><?php echo $dat->id; ?></td>
                                        <td><?php echo $dat->nombres; ?></td>
                                        <td><?php echo $dat->apellidos; ?></td>
                                        <td><?php echo $dat->edad; ?></td>
                                        <td><?php echo $dat->direccion; ?></td>
                                        <td><?php echo $dat->tel; ?></td>
                                        <td><?php echo $dat->identificacion; ?></td>
                                        <td><?php echo $dat->cargo; ?></td>

                                        <td>
                                            <a href="editar.php?id=<?php echo $dat->id; ?>" class="btn btn-small btn-warning"><i class="fas fa-wrench"></i></a>
                                            <a href="eliminar.php?id=<?php echo $dat->id; ?>" class="btn btn-small btn-danger"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                    $result->close(); // Liberar el conjunto de resultados
                                } else {
                                    echo "<tr><td colspan='8'>No hay registros encontrados</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const search = document.getElementById('search');
            const searchProfesion = document.getElementById('searchProfesion');
            const tableBody = document.getElementById('table-body');

            function filterTable() {
                const filter = search.value.toLowerCase();
                const selectedProfesion = searchProfesion.value.toLowerCase();

                Array.from(tableBody.querySelectorAll('tr')).forEach(row => {
                    const nombres = row.dataset.nombres.toLowerCase();
                    const profesion = row.dataset.profesion.toLowerCase();

                    const isMatch =
                        (nombres.includes(filter) || filter === '') &&
                        (profesion.includes(selectedProfesion) || selectedProfesion === '');

                    row.style.display = isMatch ? '' : 'none';
                });
            }

            search.addEventListener('keyup', filterTable);
            searchProfesion.addEventListener('change', filterTable);
        });
    </script>
</body>
</html>

<?php $conn->close(); ?>
