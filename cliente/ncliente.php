<?php include("../layout/inicio.php") ?>

<p>esta es la pagina de nuevo cliente</p>

<form action="ncliente.php" method="POST">

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
    <input type="submit" value="enviar">
</form>
<a href="cliente.php">regresar</a>

<?php include("../layout/fin.php") ?>




<!-- INSERT INTO `cliente` (`id`, `nombre`, `direccion`, `telefono`, `correo`) 
VALUES (NULL, 'pedro rodriguez', 'paso del toro veracruz', '2721807630', 'prueba@test.com');  -->