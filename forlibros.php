<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Libro</title>
    <link rel="stylesheet" href="estilos1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="background2">
    <center>
        <div id="B2" class="card col-sm-3" style="margin-top: 6%;">
            <div class="card-body login-card-body">
                <p class="login-box-msg"><b>Registro de Libro</b></p>
                
                <form id="formLibro" action="forintlibros.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese el Nombre del Libro" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="descripcion" class="form-control" placeholder="Ingrese una Descripción" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" name="cantidad" class="form-control" placeholder="Ingrese la Cantidad" required>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <button type="submit" class="btn btn-block btn-outline-primary btn-sm">Guardar</button><br>
                        </div>
                    </div>
                </form>

                <form action="intLibros.php">
                    <div class="col-6">
                        <br><button type="submit" class="btn btn-primary btn-block"><i class="fas fa-arrow-left"></i> Regresar</button>
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </center>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
