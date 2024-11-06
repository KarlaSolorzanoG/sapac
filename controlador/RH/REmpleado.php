<?php include '../../modelo/db.php';?>

<?php
// Datos Personales
$nombre = $_POST['nombre'];
$ap = $_POST['apellidoPaterno'];
$am = $_POST['apellidoMaterno'];
$fn = $_POST['fechaNacimiento'];
$sexo = $_POST['sexo'];
$ec = $_POST['estadoCivil'];
$tel = $_POST['telefono'];
$correo = $_POST['correo'];
$dom = $_POST['domicilio'];

// Datos de Contrato
$rfc = $_POST['rfc'];
$depto = $_POST['departamento'];
$puesto = $_POST['puesto'];
$sueldo = $_POST['sueldo'];

// Credenciales de Usuario
$contrasena = $_POST['contrasena'];

// Insertar datos en la tabla empleado
$sqlEmpleado = "INSERT INTO empleado (nombre, apellidoP, apellidoM, feNac, sexo, estadoCivil, telefono, correo, domicilio) 
VALUES ('$nombre', '$ap', '$am', '$fn', '$sexo', '$ec', '$tel', '$correo', '$dom');";

if ($conn->query($sqlEmpleado) === TRUE) {
    //obtener id del empleado
    $idEmp = $conn->insert_id;
    $feIn = date("Y-m-d"); 
    $feTer = NULL; 
    $estatus = "Activo";

    $sqlContrato = "INSERT INTO contrato (rfc, departamento, puesto, sueldo, feIn, feTer, estatus, idEmp) 
    VALUES ('$rfc', '$depto', '$puesto', '$sueldo', '$feIn', NULL, '$estatus', '$idEmp');";

    if ($conn->query($sqlContrato) === TRUE) {
        //obtener id del empleado
        $idCont = $conn->insert_id;
        $sqlPerfil = "UPDATE perfiles SET contrasena='$contrasena' WHERE idCont='$idCont';";

        if ($conn->query($sqlPerfil) === TRUE) {
            echo "Empleado y perfil registrados correctamente.";
            header("Location:../../vista/RH/homeRH.php");
        } else {
            echo "Error al registrar perfil: " . $conn->error;
        }

    } else{
        echo "Error al registrar contrato: " . $conn->error;
    }
} else{
    echo "Error al registrar empleado: " . $conn->error;
}

$conn->close();
?>

