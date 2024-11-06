<?php
include('../../modelo/db.php');

// Verifica si se ha pasado el idEmp
if (isset($_GET['idEmp'])) {
    $idEmp = $_GET['idEmp'];
    
    // Obtener información del empleado para editar
    $query = "SELECT empleado.*, contrato.*, perfiles.usuarios, perfiles.contrasena 
          FROM empleado 
          INNER JOIN contrato ON empleado.idEmp = contrato.idEmp 
          INNER JOIN perfiles ON contrato.idCont = perfiles.idCont 
          WHERE empleado.idEmp = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idEmp);
    $stmt->execute();
    $result = $stmt->get_result();
    $datos = $result->fetch_object();

    // Verifica si se encontró el empleado
    if (!$datos) {
        echo "Empleado no encontrado.";
        exit;
    }
} else {
    echo "ID de empleado no especificado.";
    exit;
}

// Aquí puedes crear un formulario para editar la información del empleado usando $datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Empleado</title>
    <link href="https://fonts.cdnfonts.com/css/biennale" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Contrato de Empleado</h1>
        <form name="frmEditar" id="frmEditar" method="POST" action="../../controlador/RH/EContrato.php?idEmp=<?= $idEmp ?>">

            <fieldset>
                <legend>Datos Personales</legend>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $datos->nombre ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="apellidoP" class="form-label">Apellido Paterno:</label>
                    <input type="text" class="form-control" id="apellidoP" name="apellidoP" value="<?= $datos->apellidoP ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="apellidoM" class="form-label">Apellido Materno:</label>
                    <input type="text" class="form-control" id="apellidoM" name="apellidoM" value="<?= $datos->apellidoM ?>" readonly>
                </div>
             
            </fieldset>

            <fieldset>
                <legend>Datos de Contrato</legend>
                <div class="mb-3">
                    <label for="rfc">RFC:</label>
                    <input class="form-control" type="text" id="rfc" name="rfc" value="<?= $datos->rfc ?>" required>
                </div>

                <div class="mb-3">
                    <label for="departamento" class="form-label">Departamento:</label>
                    <input type="text" class="form-control" id="departamento" name="departamento" value="<?= $datos->departamento ?>" required>
                </div>

                <div class="mb-3">
                    <label for="puesto">Puesto:</label>
                    <input class="form-control" type="text" id="puesto" name="puesto" value="<?= $datos->puesto ?>" required>
                </div>

                <div class="mb-3">
                    <label for="sueldo">Sueldo:</label>
                    <input class="form-control" type="number" id="sueldo" name="sueldo" value="<?= $datos->sueldo ?>" required>
                </div>

                <div class="mb-3">
                    <label for="sexo">Estatus:</label>
                    <select class="form-select" id="estatus" name="estatus" required>
                        <option value="">Seleccione</option>
                        <option value="Activo" <?= ($datos->estatus == 'Activo') ? 'selected' : '' ?>>Activo</option>
                        <option value="Inactivo" <?= ($datos->estatus == 'Inactivo') ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>

            </fieldset>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Actualizar Información</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>