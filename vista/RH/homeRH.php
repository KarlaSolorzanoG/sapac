<?php include '../headers/headerRH.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Recursos Humanos</title>

    <link href="https://fonts.cdnfonts.com/css/biennale" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
        <h1>Gestión de Empleados</h1>
        <form name="frmempleado" id="frmempleado" method="POST" action="../../controlador/RH/REmpleado.php">
        <fieldset>
    <table class="table table-hover" style="font-size: 15px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>APELLIDO P</th>
                <th>APELLIDO M</th>
                <th>DEPARTAMENTO</th>
                <th>PUESTO</th>
                <th>USUARIO</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            include('../../modelo/db.php');
            $info = $conn->query("SELECT empleado.idEmp, nombre, apellidoP, apellidoM, departamento, puesto, usuarios
            FROM empleado INNER JOIN contrato ON empleado.idEmp = contrato.idEmp INNER JOIN perfiles ON contrato.idCont = perfiles.idCont;");
             

            while($datos = $info->fetch_object()) { ?>
                    <tr>
                    <td><?= $datos->idEmp ?></td>
                    <td onclick="window.location.href='EditarDP.php?idEmp=<?= $datos->idEmp ?>'"><?= $datos->nombre ?></td>
                    <td onclick="window.location.href='EditarDP.php?idEmp=<?= $datos->idEmp ?>'"><?= $datos->apellidoP ?></td>
                    <td onclick="window.location.href='EditarDP.php?idEmp=<?= $datos->idEmp ?>'"><?= $datos->apellidoM ?></td>
                    <td onclick="window.location.href='EditarC.php?idEmp=<?= $datos->idEmp ?>'"><?= $datos->departamento ?></td>
                    <td onclick="window.location.href='EditarC.php?idEmp=<?= $datos->idEmp ?>'"><?= $datos->puesto ?></td>
                    <td onclick="window.location.href='EditarP.php?idEmp=<?= $datos->idEmp ?>'"><?= $datos->usuarios ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</fieldset>


</body>
</html>

