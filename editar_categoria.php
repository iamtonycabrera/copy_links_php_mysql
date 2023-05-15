<?php

    include ("includes/header.php");

    if(isset($_GET['id'])){
        $idCategoria = $_GET['id'];
    }

    // Obtener la categoria
    $query = "SELECT * FROM categorias WHERE id = ?";
    $stmt = $conectar->prepare($query);
    $stmt->bindParam(1, $idCategoria, PDO::PARAM_INT);
    $stmt->execute();

    $categoria = $stmt->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['editarCategoria'])){
        // Obtenemos los valores
        $nombreCat = $_POST['nombre_categoria'];

        if(empty($nombreCat) || $nombreCat == ""){
            $error = "Error, algunos campos obligatorios estan vacios";
            header("Location: editar_categoria.php?error=" . urlencode($error));
        } else {
            $fechaActual = date("Y-m-d");

            // Si entra por aqui es porque se puede crear

            $query = "UPDATE categorias SET  nombre = :nombre WHERE id = :id";

            $stmt = $conectar->prepare($query);

            $stmt->bindParam(':nombre', $nombreCat, PDO::PARAM_STR);
            $stmt->bindParam(':id', $idCategoria, PDO::PARAM_INT);

            $resultado = $stmt->execute();

            if($resultado){
                $mensaje = "Categoria editada";
                header("Location: index.php?mensaje=" . urlencode($mensaje));
                exit();
            } else {
                $error = "Error, no se pudo editar la categoria";
                header("Location: index.php?error=" . urlencode($error));
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

<h2 class="text-center">EDITAR CATEGORÍA</h2>

<div class="container card">
    <div class="row">
        <div class="col-6 offset-3">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre categoría:</label>
                <input type="text" class="form-control" name="nombre_categoria" placeholder="Ingresa el nombre de la categoría" value="<?php echo $categoria->nombre ?>">                
            </div>           
            
            <button type="submit" class="btn btn-primary w-100" name="editarCategoria">Editar Categoría</button>
            </form>
        </div>
    </div>
</div>
<?php include ("includes/footer.php"); ?>