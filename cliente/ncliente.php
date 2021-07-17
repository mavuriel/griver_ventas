<?php include("../layout/inicio.php") ?>

<?php


$name = (isset($_REQUEST['nombre'])) ? $_REQUEST['nombre'] : "";
$dir = (isset($_REQUEST['direccion'])) ? $_REQUEST['direccion'] : "";
$num = (isset($_REQUEST['telefono'])) ? $_REQUEST['telefono'] : "";
$email = (isset($_REQUEST['email'])) ? $_REQUEST['email'] : "";
$btn = (isset($_REQUEST['boton'])) ? $_REQUEST['boton'] : "";

include("../config/db.php");

switch ($btn) {
    case "enviar":
        $sql = $conexion
            ->prepare("INSERT INTO `cliente` (nombre,direccion,telefono,correo) VALUES (:nombre,:dir,:tel,:email);");
        $sql->bindParam(':nombre', $name);
        $sql->bindParam(':dir', $dir);
        $sql->bindParam(':tel', $num);
        $sql->bindParam(':email', $email);
        $sql->execute();
        break;
}
?>

<p>esta es la pagina de nuevo cliente</p>

<form method="POST">

    <label>
        Nombre
        <input type="text" name="nombre">
    </label>
    <br>
    <label>
        Dirección
        <input type="text" name="direccion">
    </label>
    <br>
    <label>
        Telefono
        <input type="number" name="telefono">
    </label>
    <br>
    <label>
        Correo electronico
        <input type="email" name="email">
    </label>
    <br>
    <button type="submit" name="boton" value="enviar">Enviar</button>
</form>
<a href="cliente.php">regresar</a>

<?php include("../layout/fin.php") ?>