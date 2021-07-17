<?php
$id = (isset($_REQUEST['idc'])) ? $_REQUEST['idc'] : "";
$btn = (isset($_REQUEST['boton'])) ? $_REQUEST['boton'] : "";

include("../config/db.php");

switch ($btn) {
    case "eliminar":
        $sql = $conexion->prepare("DELETE FROM cliente WHERE id=:id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        break;
    case "editar":
        header("Location: editCliente.php?id=" . $id);
}

$sql = $conexion->prepare("SELECT * FROM cliente");
$sql->execute();
$clientes = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../layout/inicio.php") ?>

<div class="col-md-12">

    <div class="d-grid gap-2 mb-3 ">
        <a class="btn btn-lg btn-info" type="button" href="ncliente.php">
            Agregar nuevo cliente
        </a>
    </div>

    <table class="table table-hover text-center">
        <thead>
            <tr class="table-dark align-middle">
                <th colspan="6">Lista de usuarios</th>
            </tr>
            <tr class="table-dark">
                <td scope="col">#</td>
                <td scope="col">Nombre</td>
                <td scope="col">Dirección</td>
                <td scope="col">Teléfono</td>
                <td scope="col">Correo</td>
                <td scope="col"></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $c) { ?>
                <tr class="table-light align-middle">
                    <td scope="row"><?php echo $c['id']; ?></td>
                    <td><?php echo $c['nombre']; ?></td>
                    <td><?php echo $c['direccion']; ?></td>
                    <td><?php echo $c['telefono']; ?></td>
                    <td><?php echo $c['correo']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="idc" id="idc" value="<?php echo $c['id']; ?>">
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