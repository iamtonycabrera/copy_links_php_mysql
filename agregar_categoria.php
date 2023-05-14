<?php include ("includes/header.php"); ?>

<div class="container mt-3">
<div class="row">
    <div class="col-sm-12">
       
            <h4 class="bg-danger text-white"></h4>
      
        </div>
    </div>
</div>

<h2 class="text-center">AGREGAR NUEVA CATEGORÍA</h2>

<div class="container card">
    <div class="row">
        <div class="col-6 offset-3">
        <form method="POST" action="">
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