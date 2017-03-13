        <!-- este footer lo llamo desde el javascript para el frontpage de normal esta oculto -->
        <!--style="display:none"-->
        <footer class="footerfp footer-front-page">
            <div class="container">
                <div class="searchtitle">Search words:</div>
                <?php get_search_form(); ?>
            </div>
            <div class="logo">
                <h1 class="h1">HOGWARTS</h1>
            </div>
            <div class="links">
                <ul class="links-ul">
                    <li class="h1"><p class="p">VISIT</p></li>
                    <li class="h1"><a class="a" href="<?php echo get_settings('home'); ?>">Home</a></li>
                    <li class="h1"><a class="a" href="<?php echo get_page_link(get_page_by_title('Blog')->ID);?>">Blog</a></li>
                    <li class="h1"><a class="a" href="<?php echo get_page_link(get_page_by_title('Activities')->ID);?>">Activities</a></li>
                    
                </ul>
                <ul class="links-ul">
                    <li class="h1"><p class="p">TEACHERS</p></li>
                    <li class="h1"><a class="a" href="#">Carmelo</a></li>
                    <li class="h1"><a class="a" href="#">Aurora</a></li>
                </ul>
                <ul class="links-ul">
                    <li class="h1"><p class="p">ALGO</p></li>
                    <li class="h2"><a class="a" href="#"></a></li>
                </ul>
            </div>
            <div class="location">
                <div class="container-hs">
                    <h1 class="h1">GARDENS REOPEN FOR VISITATION ON APRIL 1. CLASSES OFFERED YEAR-ROUND.</h1>
                    <h1 class="h1">3120 BARLEY MILL RD, HOCKESSIN, DE 19707</h1>
                    <h1 class="h1">302.239.4244</h1>
                </div>
                
            </div>
            <div class="social">
                <div class="container-hs">
                    <a class="a a-01" href="#">X</a>
                    <a class="a a-02" href="#">Y</a>
                    <a class="a a-03" href="#">[</a>
                    <a class="a a-04" href="#">a</a>
                </div>
                
            </div>
            
        </footer>
        
        <!-- le puse id para poder eliminarlo con el javascript y meter el que quiero -->
        <!--<footer id="footer">-->
              
        <!--</footer>-->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-3.1.1.min.js"><\/script>')</script>
        
        <!--<script src="<?php // echo bloginfo('template_url');?>/js/bootstrap.min.js"></script>-->
        
<!--        Para graficos         -->
        <script src="<?php echo bloginfo('template_url'); ?>/js/rescaladoLetra.js"></script>
        <script src="<?php echo bloginfo('template_url'); ?>/js/front-page.js"></script>
         <script src="<?php echo bloginfo('template_url'); ?>/js/index.js"></script>
        <!-- Animate -->
        <script src="<?php echo bloginfo('template_url'); ?>/js/animate/jquery.fittext.js"></script>
        <script src="<?php echo bloginfo('template_url'); ?>/js/animate/jquery.lettering.js"></script>
        <script src="<?php echo bloginfo('template_url'); ?>/js/animate/jquery.textillate.js"></script>
        <?php
            wp_footer();
        ?>
    </body>
</html>