<?php
    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: /');
    }

    // Base de datos

    require '../../includes/config/database.php';
    $db = conectarDB();

    // Consultar para obtener vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedores_id = '';

    // Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // echo'<pre>';
        // var_dump($_POST);
        // echo'</pre>';

        // echo'<pre>';
        // var_dump($_FILES);
        // echo'</pre>';

        

        $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
        $precio = mysqli_real_escape_string( $db,  $_POST['precio']);
        $descripcion = mysqli_real_escape_string( $db,  $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string( $db,  $_POST['habitaciones']);
        $wc = mysqli_real_escape_string( $db,  $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string( $db,  $_POST['estacionamiento']);
        $vendedores_id = mysqli_real_escape_string( $db,  $_POST['vendedor']);
        $creado = mysqli_real_escape_string( $db,  date('Y-m-d'));

        // Asignar a files hacia una variable
        $imagen = $_FILES['imagen'];

    


        if(!$titulo){
            $errores[] = 'Debes añadir un titulo';
        }

        if(!$precio){
            $errores[] = 'El Precio es Obligatorio';
        }

        if(strlen($descripcion) < 50){
            $errores[] = 'La Descripcion es Obligatoria y debe tener minimo 50 caracteres';
        }

        if(!$habitaciones){
            $errores[] = 'El Numero de habitaciones es obligatorio';
        }

        if(!$wc){
            $errores[] = 'El Numero de Baños es obligatorio';
        }

        if(!$estacionamiento){
            $errores[] = 'El Numero de lugares de Estacionamiento es obligatorio';
        }

        if(!$vendedores_id){
            $errores[] = 'Elige un vendedor';
        }

        // Revisar que el array de errores este vacio
        if(empty($errores)){

            // Subida de archivos

            // Crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
   

            // Insertar en la Base de Datos
            $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado,  vendedores_id) VALUES ( '$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado',  '$vendedores_id' ) ";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                // Redireccionar al usuario.
                header("Location: /admin?resultado=1");
            }
        }

        if(!$imagen['name'] || $imagen['error']){
            $errores[] = "La imagen es Obligatoria";
        }

        // Validar por tamaño (1 mb máximo)
        $medida = 1000 * 1000;

        if($imagen['size'] > $medida){
            $errores[] = 'La imagen es Muy Pesada';
        }; 
    }

    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):  ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo Propiedad" value='<?php $titulo; ?>'>

                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" placeholder="Precio Propiedad" value='<?php $precio; ?>'>

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion"><?php $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value='<?php $habitaciones; ?>'>

                <label for="wc">Baños:</label>
                <input type="number" name="wc" id="wc" placeholder="Ej: 3" min="1" max="9" value='<?php $wc; ?>'>

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" min="1" max="9" value='<?php $estacionamiento; ?>'>
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">--- Seleccione ---</option>
                    <?php while( $vendedor = mysqli_fetch_assoc($resultado) ) : ?>
                        <option  <?php echo $vendedores_id === $vendedor['id'] ? 'selected' : ''; ?>  value="<?php echo $vendedor['id']; ?>"> <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?> </option>
                    <?php endwhile ?>
                </select>
            </fieldset>

            <input type="submit" name="" id="" value="Crear Propiedad" class="boton boton-verde">
        </form>

    </main>

<?php
    incluirTemplate('footer');
?>