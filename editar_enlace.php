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
if(isset($_POST['editarEnlace'])){
    // Obtenemos los valores
    $nombreEnlace = $_POST['nombre_enlace'];
    $descripcionEnlace = $_POST['descripcion'];
    $categoriaEnlace = $_POST['categoria'];

    if(empty($nombreEnlace) || $nombreEnlace == "" || empty($descripcionEnlace) || $descripcionEnlace == "" || empty($categoriaEnlace) || $categoriaEnlace == ""){
        $error = "Error, algunos campos obligatorios estan vacios";
        header("Location: editar_enlace.php?error=" . urlencode($error));
    } else {

        // Si entra por aqui es porque se puede crear
        $query = "UPDATE enlaces SET enlace = :enlace, descripcion = :descripcion, categoria_id = :categoria_id WHERE id = :id";

        $stmt = $conectar->prepare($query);

        $stmt->bindParam(':id', $idEnlace, PDO::PARAM_INT);
        $stmt->bindParam(':enlace', $nombreEnlace, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcionEnlace, PDO::PARAM_STR);
        $stmt->bindParam(':categoria_id', $categoriaEnlace, PDO::PARAM_INT);

        $resultado = $stmt->execute();

        if($resultado){
            $mensaje = "Enlace editado";
            header("Location: index.php?mensaje=" . urlencode($mensaje));
            exit();
        } else {
            $error = "Error, no se pudo editar el enlace";
            header("Location: index.php?error=" . urlencode($error));
            exit();
        }
    }
}

?>

<div class="container mt-3">
    <div class="row">
        <div class="col-sm-12">

            <h4 class="bg-danger text-white"></h4>

        </div>
    </div>
</div>

<h2 class="text-center">EDITAR ENLACE</h2>

<div class="container card">
    <div class="row">
        <div class="col-6 offset-3">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Enlace:</label>
                    <input type="text" class="form-control" name="nombre_enlace" placeholder="Ingresa el enlace"
                    value="<?php echo $enlace->enlace ?>">
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" name="descripcion" placeholder="Ingresa la descripción"
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

                <button type="submit" class="btn btn-primary w-100" name="editarEnlace">Editar Enlace</button>
            </form>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>