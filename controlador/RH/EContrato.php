<?php
include '../../modelo/db.php';

// Verificar si se ha pasado el idEmp y si los campos requeridos están presentes
if (isset($_GET['idEmp']) && !empty($_POST)) {
    $idEmp = $_GET['idEmp'];
    
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidoP = $_POST['apellidoP'];
    $apellidoM = $_POST['apellidoM'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $sexo = $_POST['sexo'];
    $estadoCivil = $_POST['estadoCivil'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $domicilio = $_POST['domicilio'];

    // Preparar la consulta de actualización
    $query = "UPDATE empleado 
              SET nombre = ?, apellidoP = ?, apellidoM = ?, feNac = ?, sexo = ?, estadoCivil = ?, telefono = ?, correo = ?, domicilio = ? 
              WHERE idEmp = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssi", $nombre, $apellidoP, $apellidoM, $fechaNacimiento, $sexo, $estadoCivil, $telefono, $correo, $domicilio, $idEmp);

    // Ejecutar la consulta y verificar si se actualizó correctamente
    if ($stmt->execute()) {
        echo "Información actualizada correctamente.";
        header("Location:../../vista/RH/homeRH.php");
        exit;
    } else {
        echo "Error al actualizar la información del empleado.";
    }

    $stmt->close();
} else {
    echo "Datos incompletos o id de empleado no especificado.";
}
$conn->close();
?>


