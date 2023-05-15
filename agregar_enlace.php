<?php

include("includes/header.php");

// Obtener lista de categorias
$queryCat = "SELECT * FROM categorias";
$stmt = $conectar->prepare($queryCat);
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_OBJ);

if(isset($_POST['crearEnlace'])){
    // Obtenemos los valores
    $enlace = $_POST['nombre_enlace'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];

    if(empty($enlace) || $enlace == "" || empty($descripcion) || $descripcion == "" || empty($categoria) || $categoria == ""){
        $error = "Error, algunos campos obligatorios estan vacios";
        header("Location: agregar_enlace.php?error=" . urlencode($error));
    } else {
        $fechaActual = date("Y-m-d");

        // Si entra por aqui es porque se puede crear

        $query = "INSERT INTO enlaces (enlace, descripcion, fecha_creacion, categoria_id) VALUES(:enlace, :descripcion, :fecha_creacion, :categoria_id)";

        $stmt = $conectar->prepare($query);

        $stmt->bindParam(':enlace', $enlace, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_creacion', $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(':categoria_id', $categoria, PDO::PARAM_INT);

        $resultado = $stmt->execute();

        if($resultado){
            $mensaje = "Enlace creado";
            header("Location: index.php?mensaje=" . urlencode($mensaje));
            exit();
        } else {
            $error = "Error, no se pudo crear el enlace";
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

<h2 class="text-center">AGREGAR NUEVO ENLACE</h2>

<div class="container card">
    <div class="row">
        <div class="col-6 offset-3">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Enlace:</label>
                    <input type="text" class="form-control" name="nombre_enlace" placeholder="Ingresa el enlace">
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" name="descripcion" placeholder="Ingresa la descripción">
                </div>

                <div class="mb-3">
                    <label for="categorias" class="form-label">Categoría:</label>
                    <select class="form-select" name="categoria">
                        <option value="">--Selecciona una categoría--</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo $categoria->id ?>">
                                <?php echo $categoria->nombre ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100" name="crearEnlace">Crear Enlace</button>
            </form>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>