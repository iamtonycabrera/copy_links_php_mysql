<?php

include("includes/header.php");

if (isset($_GET['id'])) {
    $idCategoria = $_GET['id'];
}

// Obtener la categoria
$query = "SELECT * FROM categorias WHERE id = ?";
$stmt = $conectar->prepare($query);
$stmt->bindParam(1, $idCategoria, PDO::PARAM_INT);
$stmt->execute();

$categoria = $stmt->fetch(PDO::FETCH_OBJ);

if (isset($_POST['borrarCategoria'])) {
    // Obtenemos los valores

    $query = "DELETE FROM categorias WHERE id = :id";
    $stmt = $conectar->prepare($query);
    $stmt->bindParam(':id', $idCategoria, PDO::PARAM_INT);
    $resultado = $stmt->execute();

    if ($resultado) {
        $mensaje = "Categoria borrada";
        header("Location: index.php?mensaje=" . urlencode($mensaje));
        exit();
    } else {
        $error = "Error, no se pudo borrar la categoria";
        header("Location: index.php?error=" . urlencode($error));
    }
}



?>

<div class="row">
    <div class="col-sm-12">
        <?php if(isset($error)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo $error ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
    </div>
</div>

<h2 class="text-center">BORRAR CATEGORÍA</h2>

<div class="container card">
    <div class="row">
        <div class="col-6 offset-3">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre categoría:</label>
                    <input readonly type="text" class="form-control" name="nombre_categoria"
                        placeholder="Ingresa el nombre de la categoría" value="<?php echo $categoria->nombre ?>">
                </div>

                <button type="submit" class="btn btn-primary w-100" name="borrarCategoria">Borrar Categoría</button>
            </form>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>