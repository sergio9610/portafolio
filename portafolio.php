<?php include("cabecera.php"); ?>
<?php include("conexion.php"); ?>

<?php

if ($_POST) {
    
    $nombre=$_POST['nombre'];
    $descripcion=$_POST['descripcion'];

    $fecha = new DateTime();    // se crea fecha para concatenar en la imagen
    
    $imagen=$fecha->getTimestamp()."_".$_FILES['archivo']['name'];

    $imagenTemporal=$_FILES['archivo']['tmp_name'];

    move_uploaded_file($imagenTemporal,"imagenes/".$imagen); 

    // se crea instancia de conexión 
    $objConexion = new conexion();
    
    // se genera instrucción sql accediendo al método ejecutar
    $sql="INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion');";
    $objConexion->ejecutar($sql);
    header("location::portfolio.php");
    
}

if($_GET){
    $id=$_GET['borrar'];
    $objConexion = new conexion();
    $imagen=$objConexion->consultar("SELECT imagen FROM `proyectos` WHERE id=".$id);
    
    unlink("imagenes/".$imagen[0]['imagen']);   //se elimina la el archivo de la imagen

    $sql = "DELETE FROM `proyectos` WHERE `proyectos`.`id` =".$id; // se realiza el borrado en la base de datos
    $objConexion->ejecutar($sql);
    header("location::portfolio.php");
}

$objConexion = new conexion();
$proyectos = $objConexion->consultar("SELECT * FROM `proyectos`");
//print_r($resultado);

?>


<br>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            
            <div class="card">
                <div class="card-header">
                    Datos del proyecto
                </div>
                <div class="card-body">
            
                    <form action="portafolio.php" method="post" enctype="multipart/form-data">  <!-- el enctype permite recepcionar los archivos -->
                    
                        Nombre del proyecto: <input required class="form-control" type="text" name="nombre" id=""> <br>
                        Imagen del proyecto: <input required class="form-control" type="file" name="archivo" id=""> <br>
                    
                        Descripción: <br>
                        <textarea required class="form-control" name="descripcion" id="" rows="3"></textarea> <br> <br>
                        

                        <input class="btn btn-success" type="submit" value="Enviar proyecto">
                    
                    </form>
            
                </div>
                
            </div> <br>

        </div>
        <div class="col-md-6">
            
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proyectos as $proyecto) { ?>
                        
                    <tr>
                        <td><?php echo $proyecto['id']; ?></td>
                        <td><?php echo $proyecto['nombre']; ?></td>
                        <td>
                            <img width="100"  src="imagenes/<?php echo $proyecto['imagen']; ?>" alt="" srcset="">

                        
                        </td>
                        <td><?php echo $proyecto['descripcion']; ?></td>
                        <td><a class="btn btn-danger" href="?borrar=<?php echo $proyecto['id'] ?>">Eliminar</a></td><!-- se elimina por medio de envio GET -->
                    </tr>
                    <?php } ?>
                    
                </tbody>
            </table>
            
        </div>
        
    </div>
</div>





<?php include("pie.php"); ?>