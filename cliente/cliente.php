<?php include("../layout/inicio.php") ?>

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


<table>
    <tr>
        <td>id</td>
        <td>nombre</td>
        <td>direccion</td>
        <td>telefono</td>
        <td>correo</td>
        <td></td>
    </tr>
    <?php foreach ($clientes as $c) { ?>
        <tr>
            <td><?php echo $c['id']; ?></td>
            <td><?php echo $c['nombre']; ?></td>
            <td><?php echo $c['direccion']; ?></td>
            <td><?php echo $c['telefono']; ?></td>
            <td><?php echo $c['correo']; ?></td>
            <td>
                <form method="POST">
                    <input type="txt" name="idc" id="idc" value="<?php echo $c['id']; ?>">
                    <input type="submit" name="boton" value="editar">
                    </input>
                    <input type="submit" name="boton" value="eliminar">
                    </input>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>
<a href="ncliente.php">agregar nuevo cliente</a>

<?php include("../layout/fin.php") ?>