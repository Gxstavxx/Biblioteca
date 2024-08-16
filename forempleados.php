<!-- registro_form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REGISTRAR EMPLEADOS</title>
    <link rel="stylesheet" href="estilos1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="background2">
    <center>
        <div id="B2" class="card col-sm-3" style="margin-top: 6%;">
            <div class="card-body login-card-body">
                <p class="login-box-msg"><b>Registro de Profesor</b></p>
                
                <div class="custom-controls-stacked row text-center pb-3">
                    <div class="custom-control custom-radio col-md-4 text-right">
                        <input id="tipoBusqueda2" name="tipoBusqueda" value="2" type="radio" class="custom-control-input tipoBusqueda" checked="checked">
                        <label for="tipoBusqueda2" class="custom-control-label">Profesor</label>
                    </div>
                </div>

                <!-- Formulario Profesor -->
                <form id="formProfesor" action="registropro.php" method="post">
                    <input type="hidden" name="tipo" value="profesor">
                    <div class="input-group mb-3">
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese sus Nombres" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="apellido" class="form-control" placeholder="Ingrese sus Apellidos" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="profesion" class="form-control" placeholder="Ingrese su Profesion" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="nickname" id="nickname" class="form-control" placeholder="Usuario" required onblur="addProfToNickname(this)">
                    </div>
                    <?php if (isset($errorMsg)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlspecialchars($errorMsg); ?>
                        </div>
                    <?php endif; ?>
                    <div class="input-group mb-3">
                        <input type="email" name="correo" class="form-control" placeholder="Correo" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="contraseña" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <button type="submit" class="btn btn-block btn-outline-primary btn-sm">Guardar</button><br>
                        </div>
                    </div>
                </form>

                <form action="interfaz1.php">
                    <div class="col-6">
                        <br><button type="submit" class="btn btn-primary btn-block"><i class="fas fa-arrow-left"></i> Regresar</button>
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </center>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipoBusqueda2 = document.getElementById('tipoBusqueda2');
        const formProfesor = document.getElementById('formProfesor');

        tipoBusqueda2.addEventListener('change', function() {
            if (tipoBusqueda2.checked) {
                formProfesor.style.display = 'block';
            }
        });
    });

    function addProfToNickname(input) {
        const value = input.value.trim();
        const cursorPosition = input.selectionStart;
        const lastIndexOfProf = value.lastIndexOf('-prof');

        if (lastIndexOfProf === -1 || cursorPosition <= lastIndexOfProf) {
            input.value = value + '-prof';
        } else if (cursorPosition > lastIndexOfProf + 5) {
            input.setSelectionRange(lastIndexOfProf + 5, lastIndexOfProf + 5);
        }
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
