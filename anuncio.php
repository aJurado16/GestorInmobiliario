<?php
    // Validar la URL id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /');
    }

    require 'includes/funciones.php';
    incluirTemplate('header');

    

    // Importar la conexion
    require 'includes/config/database.php';
    $db = conectarDB();

    // Consultar
    $query = "SELECT * FROM propiedades WHERE id = $id";
    

    // Obtener resultado
    $resultado = mysqli_query($db, $query);

    if(!$resultado -> num_rows){
        header("Location: /");
    };

    $propiedad = mysqli_fetch_assoc($resultado);
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>

        <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen de la propiedad" loading="lazy">

        
        <div class="resumen-propiedad">
            <p class="precio"><?php echo '$' . number_format($propiedad['precio'], 2, '.', ','); ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" loading="lazy">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>
            <p><?php echo $propiedad['descripcion']; ?></p>
        </div>
    </main>

<?php
    incluirTemplate('footer');

    // Cerrar la conexion
    mysqli_close($db);
?>