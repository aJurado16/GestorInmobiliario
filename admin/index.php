<?php
    require '../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: /');
    }

    

    // Importar la conexion
    require '../includes/config/database.php';
    $db = conectarDB();

    // Escribir el query
    $query = "SELECT * FROM propiedades";

    // Consultar la base de datos
    $resultadoConsulta = mysqli_query($db, $query);


    // Muestrame mensaje condicional
    $resultado = $_GET["resultado"] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            // Eliminar archivo
            $query = "SELECT imagen FROM PROPIEDADES where ID = $id";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);

            unlink('../imagenes/' . $propiedad['imagen']); 


            $query = "DELETE FROM propiedades WHERE id = $id";
            $resultado = mysqli_query($db, $query);

            if($resultado){
                header("Location: /admin?resultado=3");
            }
        }
        
    }
  
    // Incluye un template
    
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if( intval($resultado) === 1): ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php elseif( intval($resultado) === 2): ?>
            <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php elseif( intval($resultado) === 3): ?>
            <p class="alerta exito">Anuncio Eliminado Correctamente</p>
        <?php endif ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>


        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resutados -->
                <?php while( $propiedad = mysqli_fetch_assoc($resultadoConsulta) ) : ?>
                    <tr>
                        <td><?php echo $propiedad['id'] ?></td>
                        <td><?php echo $propiedad['titulo'] ?></td>
                        <td><img src="/imagenes/<?php echo $propiedad['imagen'] ?>" class="imagen-tabla" alt=""></td>
                        <td><?php echo $propiedad['precio'] ?></td>
                        <td>
                            <form method="post" class="w-100" action="">
                                <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            
                            <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </main>

<?php

    // Cerrar conexion
    mysqli_close($db);

    incluirTemplate('footer');
?>