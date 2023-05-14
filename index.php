<?php include ("includes/header.php"); ?>

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
       
            <tr>
                <td>2</td>
                <td>Test</td>
                <td>Test</td>
                <td>
                    <a href="#" class="btn btn-success">Editar</a>
                    <a href="#" class="btn btn-danger">Borrar</a>
                </td>            
            </tr> 
             
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
       
            <tr>
                <td>1</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td> 
                <td>Test</td>  
                <td>               
                    <a href="#" class="btn btn-success">Editar</a>
                    <a href="#" class="btn btn-danger">Borrar</a>
                </td>             
            </tr> 
                       
        </tbody>                
    </table>
        </div>
    </div>
  <?php include ("includes/footer.php"); ?>