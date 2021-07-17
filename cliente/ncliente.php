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
<?php include("../layout/inicio.php") ?>

<div class="col-md-12 d-flex flex-column align-items-center  justify-content-center">

    <div class="card border-light my-5" style="width: 30rem;">
        <div class="card-header text-center">
            <h4 class="card-title">Nuevo cliente</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group text-left mb-2">
                    <label for="nom">Nombre</label>
                    <input id="nom" type="text" class="form-control" name="nombre" placeholder="p. ej. Pedro Martinez Herrera">
                </div>
                <div class="form-group text-left mb-2">
                    <label for="dir">Dirección</label>
                    <input id="dir" type="text" class="form-control" name="direccion" placeholder="p. ej. Camino real #266 col. centro">
                </div>
                <div class="form-group text-left mb-2">
                    <label for="tel">Teléfono</label>
                    <input id="tel" type="number" class="form-control" name="telefono" placeholder="p. ej. 2299988475">
                </div>
                <div class="form-group text-left">
                    <label for="correo">Correo electronico</label>
                    <input id="correo" type="email" class="form-control" name="email" placeholder="p. ej. ventas@gmail.com">
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-lg btn-success" type="submit" name="boton" value="enviar">Guardar</button>
                </div>
            </form>
        </div>

    </div>
    <div class="d-grid mt-1" style="width: 30rem;">
        <a class="btn btn-lg btn-info" href="cliente.php">Regresar</a>
    </div>
</div>

<?php include("../layout/fin.php") ?>