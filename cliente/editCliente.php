<?php
$id = $_GET['id'];
include("../config/db.php");
$sql = $conexion->prepare("SELECT * FROM cliente WHERE id=:id");
$sql->bindParam(':id', $id);
$sql->execute();
$cliente = $sql->fetch(PDO::FETCH_LAZY);

$nombre = $cliente['nombre'];
$dirc = $cliente['direccion'];
$telf = $cliente['telefono'];
$correo = $cliente['correo'];

$name = (isset($_REQUEST['nombre'])) ? $_REQUEST['nombre'] : "";
$dir = (isset($_REQUEST['direccion'])) ? $_REQUEST['direccion'] : "";
$num = (isset($_REQUEST['telefono'])) ? $_REQUEST['telefono'] : "";
$email = (isset($_REQUEST['email'])) ? $_REQUEST['email'] : "";
$btn = (isset($_REQUEST['boton'])) ? $_REQUEST['boton'] : "";

switch ($btn) {
    case "editar":
        $sql = $conexion
            ->prepare("UPDATE cliente SET nombre=:nombre ,direccion=:dir,telefono=:tel,correo=:email WHERE id=:id");
        $sql->bindParam(':id', $id);
        $sql->bindParam(':nombre', $name);
        $sql->bindParam(':dir', $dir);
        $sql->bindParam(':tel', $num);
        $sql->bindParam(':email', $email);
        $sql->execute();

        if ($sql) {
            $nombre = $name;
            $dirc = $dir;
            $telf = $num;
            $correo = $email;
        }
        break;
}

?>

<?php include("../layout/inicio.php") ?>

<p>esta es la pagina de editar cliente numero <?php echo $id; ?></p>

<form method="POST">

    <label>
        Nombre
        <input type="text" name="nombre" value="<?php echo $nombre; ?>">
    </label>
    <br>
    <label>
        Dirección
        <input type="text" name="direccion" value="<?php echo $dirc; ?>">
    </label>
    <br>
    <label>
        Telefono
        <input type="number" name="telefono" value="<?php echo $telf; ?>">
    </label>
    <br>
    <label>
        Correo electronico
        <input type="email" name="email" value="<?php echo $correo; ?>">
    </label>
    <br>
    <button type="submit" name="boton" value="editar">Enviar</button>
</form>
<a href="cliente.php">regresar</a>

<?php include("../layout/fin.php") ?>