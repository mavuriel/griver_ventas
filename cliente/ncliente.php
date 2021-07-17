<?php
$name = (isset($_REQUEST['nombre'])) ? $_REQUEST['nombre'] : "";
$dir = (isset($_REQUEST['direccion'])) ? $_REQUEST['direccion'] : "";
$num = (isset($_REQUEST['telefono'])) ? $_REQUEST['telefono'] : "";
$email = (isset($_REQUEST['email'])) ? $_REQUEST['email'] : "";
$btn = (isset($_REQUEST['boton'])) ? $_REQUEST['boton'] : "";

include("../config/db.php");
$errores = array();
$regexNombre = "/^([A-Z]([a-z])*(\s)*)*$/";

if ($btn == "enviar") {
    if (!empty($_REQUEST)) {
        if (empty($name)) {
            array_push($errores, "El campo nombre es requerido.");
        } elseif (!preg_match($regexNombre, $name)) {
            array_push($errores, "El formato del campo nombre es incorrecto.");
        }

        if (empty($dir)) {
            array_push($errores, "El campo dirección es requerido.");
        }

        if (empty($num)) {
            array_push($errores, "El campo teléfono es requerido.");
        } elseif (!is_numeric($num)) {
            array_push($errores, "Debe ingresar numeros en el campo teléfono.");
        } elseif (mb_strlen($num) < 10) {
            array_push($errores, "El teléfono deben ser de 10 digitos.");
        } elseif (mb_strlen($num) > 10) {
            array_push($errores, "El teléfono debe ser de 10 digitos maximo.");
        }

        if (empty($email)) {
            array_push($errores, "El campo correo es requerido.");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errores, "El formato del correo electronico es incorrecto.");
        }
    }
    if (count($errores) == 0) {
        $sql = $conexion
            ->prepare("INSERT INTO `cliente` (nombre,direccion,telefono,correo) VALUES (:nombre,:dir,:tel,:email);");
        $sql->bindParam(':nombre', $name);
        $sql->bindParam(':dir', $dir);
        $sql->bindParam(':tel', $num);
        $sql->bindParam(':email', $email);
        $sql->execute();
        $d = "Datos almacenados";
    }
}

?>
<?php include("../layout/inicio.php") ?>

<div class="col-md-12 d-flex flex-column align-items-center  justify-content-center">

    <div class="card border-light my-4" style="width: 30rem;">
        <div class="card-header text-center text-white bg-dark">
            <h4 class="card-title">Nuevo cliente</h4>
        </div>
        <div class="card-body">

            <?php
            if (isset($d)) {
                echo '<div class="alert alert-success">';
                echo "<p>Datos ingresados correctamente</p>";
                echo '</div>';
            }

            if (count($errores) >= 1) {
                echo '<div class="alert alert-danger"> <ul>';
                foreach ($errores as $e) {
                    echo "<li>$e</li>";
                }
                echo '</ul> </div>';
            }
            ?>
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

    <div class="d-grid mt-2" style="width: 30rem;">
        <a class="btn btn-lg btn-info" href="cliente.php">Regresar</a>
    </div>
</div>

<?php include("../layout/fin.php") ?>