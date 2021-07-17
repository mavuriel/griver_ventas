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

<div class="col-md-12 d-flex flex-column align-items-center  justify-content-center">

    <div class="card border-light my-5" style="width: 30rem;">
        <div class="card-header text-center">
            <h4 class="card-title">Cliente #<?php echo $id; ?></h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group text-left mb-2">
                    <label for="nom">Nombre</label>
                    <input id="nom" type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>" placeholder="p. ej. Pedro Martinez Herrera">
                </div>
                <div class="form-group text-left mb-2">
                    <label for="dir">Dirección</label>
                    <input id="dir" type="text" class="form-control" name="direccion" value="<?php echo $dirc; ?>" placeholder="p. ej. Camino real #266 col. centro">
                </div>
                <div class="form-group text-left mb-2">
                    <label for="tel">Teléfono</label>
                    <input id="tel" type="number" class="form-control" name="telefono" value="<?php echo $telf; ?>" placeholder="p. ej. 2299988475">
                </div>
                <div class="form-group text-left">
                    <label for="correo">Correo electronico</label>
                    <input id="correo" type="email" class="form-control" name="email" value="<?php echo $correo; ?>" placeholder="p. ej. ventas@gmail.com">
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-lg btn-success" type="submit" name="boton" value="editar">Guardar</button>
                </div>
            </form>
        </div>

    </div>
    <div class="d-grid mt-1" style="width: 30rem;">
        <a class="btn btn-lg btn-info" href="cliente.php">Regresar</a>
    </div>
</div>

<!-- <p>esta es la pagina de editar cliente numero <?php echo $id; ?></p>

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
<a href="cliente.php">regresar</a> -->

<?php include("../layout/fin.php") ?>