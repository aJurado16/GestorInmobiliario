<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/webpjpeg">
                    <img src="build/img/nosotros.jpg" alt="Sobre Nosotros" loading="lazy">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de Experiencia
                </blockquote>

                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro ad culpa dolore tenetur assumenda perferendis ut labore ipsum maiores quae optio maxime inventore, mollitia voluptates quaerat officia soluta impedit expedita!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam veniam natus in ut facere doloribus ipsum nihil quisquam libero. Harum nostrum voluptate sed magnam blanditiis quibusdam tempora quidem officiis quae.
                </p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt quis perferendis aspernatur alias nam ea officia rem, quod pariatur doloremque, accusantium excepturi assumenda ab velit accusamus exercitationem autem nemo. Delectus!</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más sobre nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque ex libero possimus. Molestiae, aliquid. Libero eum voluptatum consequatur ratione odit, perspiciatis temporibus quod aspernatur mollitia quasi, et officiis quaerat aut!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque ex libero possimus. Molestiae, aliquid. Libero eum voluptatum consequatur ratione odit, perspiciatis temporibus quod aspernatur mollitia quasi, et officiis quaerat aut!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque ex libero possimus. Molestiae, aliquid. Libero eum voluptatum consequatur ratione odit, perspiciatis temporibus quod aspernatur mollitia quasi, et officiis quaerat aut!</p>
            </div>
        </div>
    </section>

<?php
    incluirTemplate('footer');
?>