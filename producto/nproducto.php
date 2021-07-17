<?php
$clavep = (isset($_REQUEST['clavep'])) ? $_REQUEST['clavep'] : "";
$name = (isset($_REQUEST['nombre'])) ? $_REQUEST['nombre'] : "";
$num = (isset($_REQUEST['cantidad'])) ? $_REQUEST['cantidad'] : "";
$status = (isset($_REQUEST['status'])) ? $_REQUEST['status'] : "";
$btn = (isset($_REQUEST['boton'])) ? $_REQUEST['boton'] : "";

include("../config/db.php");
$errores = array();

if ($btn == "enviar") {
    if (!empty($_REQUEST)) {

        if (empty($clavep)) {
            array_push($errores, "El campo clave es requerido.");
        } elseif (!is_numeric($clavep)) {
            array_push($errores, "Debe ingresar numeros en el campo clave.");
        } elseif (mb_strlen($clavep) <= 4) {
            array_push($errores, "La clave deben ser de 5 digitos.");
        } elseif (mb_strlen($clavep) > 10) {
            array_push($errores, "La clave debe ser de 10 digitos maximo.");
        }

        if (empty($name)) {
            array_push($errores, "El campo nombre es requerido.");
        }

        if (empty($num)) {
            array_push($errores, "El campo cantidad es requerido.");
        } elseif (!is_numeric($num)) {
            array_push($errores, "Debe ingresar numeros en el campo cantidad.");
        } elseif (mb_strlen($num) > 20) {
            array_push($errores, "El cantidad debe ser de 20 digitos maximo.");
        }

        if (empty($status)) {
            array_push($errores, "Debe elegir una opcion valida en el campo estatus.");
        }
    }
    if (count($errores) == 0) {
        $sql = $conexion
            ->prepare("INSERT INTO `producto` (clavep,nombrep,cantidadp,estatus) VALUES (:clave,:nombre,:cant,:stat);");
        $sql->bindParam(':clave', $clavep);
        $sql->bindParam(':nombre', $name);
        $sql->bindParam(':cant', $num);
        $sql->bindParam(':stat', $status);
        $sql->execute();
        $d = "Datos almacenados";
    }
}

?>
<?php include("../layout/inicio.php") ?>

<div class="col-md-12 d-flex flex-column align-items-center  justify-content-center">

    <div class="card border-light my-4" style="width: 30rem;">
        <div class="card-header text-center text-white bg-dark">
            <h4 class="card-title">Nuevo producto</h4>
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
                    <label for="clave">Clave</label>
                    <input id="clave" type="number" class="form-control" name="clavep" placeholder="p. ej. 156564">
                </div>
                <div class="form-group text-left mb-2">
                    <label for="nom">Nombre</label>
                    <input id="nom" type="text" class="form-control" name="nombre" placeholder="p. ej. Consola XBOX Series X">
                </div>
                <div class="form-group text-left mb-2">
                    <label for="cant">Cantidad</label>
                    <input id="cant" type="number" class="form-control" name="cantidad" placeholder="p. ej. 15464">
                </div>
                <div class="form-group text-left">
                    <label for="stat">Estatus</label>
                    <select name="status" id="stat">
                        <option value="">Selecciona un estatus</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-lg btn-success" type="submit" name="boton" value="enviar">Guardar</button>
                </div>
            </form>
        </div>

    </div>

    <div class="d-grid mt-2" style="width: 30rem;">
        <a class="btn btn-lg btn-info" href="producto.php">Regresar</a>
    </div>
</div>

<?php include("../layout/fin.php") ?>