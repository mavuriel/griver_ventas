<?php
$id = (isset($_REQUEST['idc'])) ? $_REQUEST['idc'] : "";
$btn = (isset($_REQUEST['boton'])) ? $_REQUEST['boton'] : "";

include("../config/db.php");

switch ($btn) {
    case "eliminar":
        $sql = $conexion->prepare("DELETE FROM producto WHERE clavep=:clave");
        $sql->bindParam(':clave', $id);
        $sql->execute();
        break;
    case "editar":
        header("Location: editProducto.php?id=" . $id);
}

$sql = $conexion->prepare("SELECT * FROM producto");
$sql->execute();
$productos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../layout/inicio.php") ?>

<div class="col-md-12">

    <div class="d-grid gap-2 mb-3 ">
        <a class="btn btn-lg btn-info" type="button" href="nproducto.php">
            Agregar nuevo producto
        </a>
    </div>

    <table class="table table-hover text-center">
        <thead>
            <tr class="table-dark align-middle">
                <th colspan="6">Lista de productos</th>
            </tr>
            <tr class="table-dark">
                <td scope="col">Clave</td>
                <td scope="col">Nombre</td>
                <td scope="col">Cantidad</td>
                <td scope="col">Estatus</td>
                <td scope="col"></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $p) { ?>
                <tr class="table-light align-middle">
                    <td scope="row"><?php echo $p['clavep']; ?></td>
                    <td><?php echo $p['nombrep']; ?></td>
                    <td><?php echo $p['cantidadp']; ?></td>
                    <td><?php echo $p['estatus']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="idc" id="idc" value="<?php echo $p['clavep']; ?>">
                            <button type="submit" name="boton" value="editar" class="btn btn-warning">
                                <i class="far fa-edit"></i>
                            </button>
                            <button type="submit" name="boton" value="eliminar" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../layout/fin.php") ?>