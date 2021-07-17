<?php
$id = $_GET['id'];
include("../config/db.php");
$sql = $conexion->prepare("SELECT * FROM producto WHERE clavep=:id");
$sql->bindParam(':id', $id);
$sql->execute();
$producto = $sql->fetch(PDO::FETCH_LAZY);

/* BD */
$clave = $producto['clavep'];
$nombre = $producto['nombrep'];
$cant = $producto['cantidadp'];
$status = $producto['estatus'];

/* Formulario */
$cla = (isset($_REQUEST['clavef'])) ? $_REQUEST['clavef'] : "";
$name = (isset($_REQUEST['nombref'])) ? $_REQUEST['nombref'] : "";
$num = (isset($_REQUEST['cantf'])) ? $_REQUEST['cantf'] : "";
$stat = (isset($_REQUEST['status'])) ? $_REQUEST['status'] : "";
$btn = (isset($_REQUEST['boton'])) ? $_REQUEST['boton'] : "";

$errores = array();

if ($btn == "editar") {
    if (!empty($_REQUEST)) {

        if (empty($cla)) {
            array_push($errores, "El campo clave es requerido.");
        } elseif (!is_numeric($cla)) {
            array_push($errores, "Debe ingresar numeros en el campo clave.");
        } elseif (mb_strlen($cla) <= 4) {
            array_push($errores, "La clave deben ser de 5 digitos.");
        } elseif (mb_strlen($cla) > 10) {
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
            array_push($errores, "La cantidad debe ser de 20 digitos maximo.");
        }

        if (empty($stat)) {
            array_push($errores, "Debe elegir una opcion valida en el campo estatus.");
        }
    }
    if (count($errores) == 0) {
        $sql = $conexion
            ->prepare("UPDATE producto SET clavep = :clave, nombrep = :nombre, cantidadp = :cant, estatus = :stat WHERE producto.clavep = :id; ");
        $sql->bindParam(':id', $id);
        $sql->bindParam(':clave', $cla);
        $sql->bindParam(':nombre', $name);
        $sql->bindParam(':cant', $num);
        $sql->bindParam(':stat', $stat);
        $sql->execute();
        if ($sql) {
            $id = $cla;
            $clave = $cla;
            $nombre = $name;
            $cant = $num;
            $status = $stat;
            $d = "Datos actualizados";
        }
    }
}

?>

<?php include("../layout/inicio.php") ?>

<div class="col-md-12 d-flex flex-column align-items-center  justify-content-center">

    <div class="card border-light my-5" style="width: 30rem;">
        <div class="card-header text-center text-white bg-dark">
            <h4 class="card-title">Producto #<?php echo $id; ?></h4>
        </div>
        <div class="card-body">

            <?php
            if (isset($d)) {
                echo '<div class="alert alert-success text-center">';
                echo "<p>Datos actualizados correctamente</p>";
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
                    <label for="nom">Clave</label>
                    <input id="nom" type="text" class="form-control" name="clavef" value="<?php echo $clave; ?>" placeholder="p. ej. 165489">
                </div>
                <div class="form-group text-left mb-2">
                    <label for="dir">Nombre</label>
                    <input id="dir" type="text" class="form-control" name="nombref" value="<?php echo $nombre; ?>" placeholder="p. ej. Membresia XBOX 12 meses">
                </div>
                <div class="form-group text-left mb-2">
                    <label for="tel">Cantidad</label>
                    <input id="tel" type="number" class="form-control" name="cantf" value="<?php echo $cant; ?>" placeholder="p. ej. 1554">
                </div>
                <div class="form-group text-left">
                    <label for="stat">Estatus</label>

                    <select name="status" id="stat">
                        <option value="">Selecciona un estatus</option>
                        <?php
                        if ($status == 'activo') {
                            echo '<option selected value="activo">Activo</option>';
                            echo '<option value="inactivo">Inactivo</option>';
                        } else {
                            echo '<option selected value="inactivo">Inactivo</option>';
                            echo '<option value="activo">Activo</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-lg btn-success" type="submit" name="boton" value="editar">Guardar</button>
                </div>
            </form>
        </div>

    </div>
    <div class="d-grid mt-1" style="width: 30rem;">
        <a class="btn btn-lg btn-info" href="producto.php">Regresar</a>
    </div>
</div>

<?php include("../layout/fin.php") ?>