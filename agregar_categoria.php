<?php

    include ("includes/header.php");
    
    if(isset($_POST['crearCategoria'])){
        // Obtenemos los valores
        $nombreCat = $_POST['nombre_categoria'];

        if(empty($nombreCat) || $nombreCat == ""){
            $error = "Error, algunos campos obligatorios estan vacios";
            header("Location: agregar_categoria.php?error=" . urlencode($error));
        } else {
            $fechaActual = date("Y-m-d");

            // Si entra por aqui es porque se puede crear

            $query = "INSERT INTO categorias (nombre, fecha_creacion) VALUES(:nombre, :fecha_creacion)";

            $stmt = $conectar->prepare($query);

            $stmt->bindParam(':nombre', $nombreCat, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_creacion', $fechaActual, PDO::PARAM_STR);

            $resultado = $stmt->execute();

            if($resultado){
                $mensaje = "Categoria creada";
                header("Location: index.php?mensaje=" . urlencode($mensaje));
                exit();
            } else {
                $error = "Error, no se pudo crear la categoria";
                header("Location: index.php?error=" . urlencode($error));
            }
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

<h2 class="text-center">AGREGAR NUEVA CATEGORÍA</h2>

<div class="container card">
    <div class="row">
        <div class="col-6 offset-3">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre categoría:</label>
                <input type="text" class="form-control" name="nombre_categoria" placeholder="Ingresa el nombre de la categoría">                
            </div>           
            
            <button type="submit" class="btn btn-primary w-100" name="crearCategoria">Crear Categoría</button>
            </form>
        </div>
    </div>
</div>
<?php include ("includes/footer.php"); ?>