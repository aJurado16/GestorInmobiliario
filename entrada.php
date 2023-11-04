<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoracion de tu hogar</h1>
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img src="build/img/destacada2.jpg" alt="Imagen de la propiedad" loading="lazy">
        </picture>
        <div class="resumen-propiedad">
            <p class="informacion-meta">Escrito el: <span>20/10/2023</span> por: <span>Admin</span></p>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro ad culpa dolore tenetur assumenda perferendis ut labore ipsum maiores quae optio maxime inventore, mollitia voluptates quaerat officia soluta impedit expedita!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam veniam natus in ut facere doloribus ipsum nihil quisquam libero. Harum nostrum voluptate sed magnam blanditiis quibusdam tempora quidem officiis quae.
            </p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt quis perferendis aspernatur alias nam ea officia rem, quod pariatur doloremque, accusantium excepturi assumenda ab velit accusamus exercitationem autem nemo. Delectus!</p>
        </div>
    </main>
    
<?php
    incluirTemplate('footer');
?>