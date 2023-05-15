<?php

include("includes/header.php");

$query = 'SELECT * FROM categorias';
$stmt = $conectar->query($query);
$categorias = $stmt->fetchAll(PDO::FETCH_OBJ);

$query2 = 'SELECT e.id, e.enlace, e.descripcion, e.fecha_creacion, e.categoria_id, c.nombre 
FROM enlaces e INNER JOIN categorias c ON e.categoria_id = c.id';
$stmt = $conectar->query($query2);
$enlaces = $stmt->fetchAll(PDO::FETCH_OBJ);

?>

<h1 class="text-center">Links PHP, PDO, ORACLE</h1>

<h2 class="text-center">CATEGORÍAS</h2>

<div class="container card">
    <div class="row">
        <table id="categorias" class="table table-stripes" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Fecha de creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?php echo $categoria->id ?></td>
                        <td><?php echo $categoria->nombre ?></td>
                        <td><?php echo $categoria->fecha_creacion ?></td>
                        <td>
                            <a href="editar_categoria.php?id=<?php echo $categoria->id ?>" class="btn btn-success">Editar</a>
                            <a href="borrar_categoria.php?id=<?php echo $categoria->id ?>" class="btn btn-danger">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<h2 class="text-center mt-4">LINKS</h2>

<div class="container card">
    <div class="row">
        <table id="links" class="table table-stripes" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Enlace</th>
                    <th>Descripción</th>
                    <th>Fecha de creación</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($enlaces as $enlace): ?>
                <tr>
                    <td><?php echo $enlace->id ?></td>
                    <td><?php echo $enlace->enlace ?></td>
                    <td><?php echo $enlace->descripcion ?></td>
                    <td><?php echo $enlace->fecha_creacion ?></td>
                    <td><?php echo $enlace->nombre ?></td>
                    <td>
                        <a href="editar_enlace.php?id=<?php echo $enlace->id ?>
                        &idCategoria=<?php echo $enlace->categoria_id ?>" class="btn btn-success">
                            Editar
                        </a>
                        <a href="borrar_enlace.php?id=<?php echo $enlace->id ?>
                        &idCategoria=<?php echo $enlace->categoria_id ?>" class="btn btn-danger">Borrar</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("includes/footer.php"); ?>