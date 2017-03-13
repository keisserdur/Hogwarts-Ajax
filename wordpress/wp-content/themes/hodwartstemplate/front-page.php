<?php
/**
 *     Template Name: Actividades 
 */
  get_header();
 ?>

<div class="front-page front-page-container">
    <?php get_template_part('template-part/nav-part/nav-frontpage-movil'); ?>
    <div class="main-img">
        <div class="background-black">
            <?php get_template_part('template-part/nav-part/nav-frontpage'); ?>
            <div class="div-logo-movil">
                <p>HOGWARTS</p>
            </div>
            <div class="carrucel-letras">
                <p class="tlt">The finest school of witchcraft and wizardry in the world.</p>
            </div>
        </div>
    </div> 
    <div class="section-01">
            <h1>ABOUT HOGWARTS</h1>
            <p class="p">
                Hogwarts School of Witchcraft and Wizardry is the British wizarding school, located in the Highlands of Scotland. 
                It takes students from the United Kingdom of Great Britain and Northern Ireland, and Ireland.
            </p>
    </div>
    <div class="section-02">
        <div class="img img-01">
            <div class="background-black">
                <div class="container-hs">
                    <h1>Ordinary Creature</h1>
                    <h2>Owls</h2>
                    <h3>XX Creatures</h3>
                </div>
            </div>
        </div>
        <div class="img img-02">
            <div class="background-black">
                <div class="container-hs">
                    <h1>Dangerous Creature</h1>
                    <h2>Demiguise</h2>
                    <h3>XXXX Creatures</h3>                    
                </div>
            </div>
        </div>
    </div>
    <div class="section-03">
        <div class="letras">
            <h2>SPECIAL FEATURE</h2>
            <h1>The Prison of Azkabana</h1>
            <p>Azkaban is a fortress on an island in the middle of the North Sea. It serves the magical community of Great Britain as a prison for convicted criminals.</p>
        </div>
        
        <div class="img-01"></div>
    </div>
    <div class="section-04">
        <div class="img img-01">
            <div class="container-word">
                <div class="container-hs">
                    <h2 class="h2">in North America</h2>
                    <h1 class="h1">Ilvermorny School of Witchcraft and Wizardry</h1>
                </div>
                <h3 class="h3">Link Web...</h3>
            </div>
        </div>
        <div class="img img-02">
            <div class="container-word">
                <div class="container-hs">
                    <h2 class="h2">in France</h2>
                    <h1 class="h1">Académie de Magie Beauxbâtons</h1>                    
                </div>

                <h3 class="h3">Link Web...</h3>
            </div>
        </div>
        <div class="img img-03">
            <div class="container-word">
                <div class="container-hs">
                    <h2 class="h2">in Northern Europe</h2>
                    <h1 class="h1">Durmstrang-Institut für Zauberei</h1>                    
                </div>
                <h3 class="h3">Link Web...</h3>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
