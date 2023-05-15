<?php

include("includes/header.php");

if(isset($_GET['id']) && isset($_GET['idCategoria'])){
    $idEnlace = $_GET['id'];
    $idCategoria = $_GET['idCategoria'];
}

// Obtener el enlace
$query = "SELECT * FROM enlaces WHERE id = ?";
$stmt = $conectar->prepare($query);
$stmt->bindParam(1, $idEnlace, PDO::PARAM_INT);
$stmt->execute();

$enlace = $stmt->fetch(PDO::FETCH_OBJ);

// Obtener las categorias
$queryCat = "SELECT * FROM categorias";
$stmt = $conectar->prepare($queryCat);
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_OBJ);

/*----------------------*/
if(isset($_POST['borrarEnlace'])){
   
        // Si entra por aqui es porque se puede borrar
        $query = "DELETE FROM enlaces WHERE id = :id";
        $stmt = $conectar->prepare($query);
        $stmt->bindParam(':id', $idEnlace, PDO::PARAM_INT);
        $resultado = $stmt->execute();

        if($resultado){
            $mensaje = "Enlace borrado";
            header("Location: index.php?mensaje=" . urlencode($mensaje));
            exit();
        } else {
            $error = "Error, no se pudo borrar el enlace";
            header("Location: index.php?error=" . urlencode($error));
            exit();
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

<h2 class="text-center">BORRAR ENLACE</h2>

<div class="container card">
    <div class="row">
        <div class="col-6 offset-3">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Enlace:</label>
                    <input readonly type="text" class="form-control" name="nombre_enlace"
                    value="<?php echo $enlace->enlace ?>">
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input readonly type="text" class="form-control" name="descripcion"
                    value="<?php echo $enlace->descripcion ?>">
                </div>

                <div class="mb-3">
                    <label for="categorias" class="form-label">Categoría:</label>
                    <select class="form-select" name="categoria">
                        <option value="">--Selecciona una categoría--</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo $categoria->id ?>" <?php if($idCategoria == $categoria->id) echo "selected" ?>>
                                <?php echo $categoria->nombre ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100" name="borrarEnlace">Borrar Enlace</button>
            </form>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>