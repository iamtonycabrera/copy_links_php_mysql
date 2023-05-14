<?php include ("includes/header.php"); ?>

<div class="container mt-3">
<div class="row">
    <div class="col-sm-12">
     
            <h4 class="bg-danger text-white">Test</h4>
      
        </div>
    </div>
</div>

<h2 class="text-center">EDITAR ENLACE</h2>

<div class="container card">
    <div class="row">
        <div class="col-6 offset-3">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nombre" class="form-label">Enlace:</label>
                <input type="text" class="form-control" name="nombre_enlace" placeholder="Ingresa el enlace">                
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" placeholder="Ingresa la descripción" >                
            </div> 

             <div class="mb-3">
                <label for="categorias" class="form-label">Categoría:</label>
                <select class="form-select" name="categoria">
                    <option value="">--Selecciona una categoría--</option>
                   
                        <option>Test</option>
                                      
                </select>
            </div>         
            
            <button type="submit" class="btn btn-primary w-100" name="editarEnlace">Editar Enlace</button>
            </form>
        </div>
    </div>
</div>
<?php include ("includes/footer.php"); ?>