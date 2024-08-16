<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REGISTRAR CLIENTES</title>
    <link rel="stylesheet" href="estilos1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="background2">
    <center>
        <div id="B2" class="card col-sm-3" style="margin-top: 6%;">
            <div class="card-body login-card-body">
                <p class="login-box-msg"><b>Registro de Cliente</b></p>
                
                <!-- Formulario Cliente -->
                <form id="formCliente" action="forintclientes.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="nombres_cli" class="form-control" placeholder="Ingrese sus Nombres" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="apellidos_cli" class="form-control" placeholder="Ingrese sus Apellidos" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="date" name="edad" class="form-control" placeholder="Edad" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="direccion" class="form-control" placeholder="Dirección" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="tel" name="tel" class="form-control" placeholder="Teléfono" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="identificacion" class="form-control" placeholder="Identificación" required>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <button type="submit" class="btn btn-block btn-outline-primary btn-sm">Guardar</button><br>
                        </div>
                    </div>
                </form>

                <form action="intClientes.php">
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
        const formCliente = document.getElementById('formCliente');

        tipoBusqueda2.addEventListener('change', function() {
            if (tipoBusqueda2.checked) {
                formCliente.style.display = 'block';
            }
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
