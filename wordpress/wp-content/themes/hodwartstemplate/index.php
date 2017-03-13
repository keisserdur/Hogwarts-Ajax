<div class="fran">
<?php get_header();?>
<?php get_template_part('template-parts/nav');?>

 <?php /*PRIMER LOOP PARA SACAR EL PRIMER POST*/
    $args = array(
        'posts_per_page' => 1,
        'post_type'=>array('post'),
        'tax_query' => array(
            array(                
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array( 
                    'post-format-audio',
                    'post-format-gallery',
                    'post-format-image',
                    'post-format-link',
                    'post-format-quote',
                    'post-format-video'
                ),
                'operator' => 'NOT IN'
            ),
        ),
    );
    $custom_query = new WP_Query($args);
    if($custom_query->have_posts()){
        while($custom_query->have_posts()) {
            $custom_query->the_post();
    
            $defaults = array('fields' => 'names');
            $mis_categorias = wp_get_post_categories($post->ID, $defaults);
        
        
    ?>
<!-- Header Carousel -->
     <div class="head">
            <header id="backgroundHeader"class="imgGenericoFlex" style="background-image:url('<?php bloginfo('template_url'); ?>/img/fondo.jpg')">
            
            </header>
            <nav>
                <ol class="links">
                     <a class="nav-link active unoLink" href="<?php echo get_settings('home'); ?>">Home</a><!-- Inicial -->
                     <a class="nav-link dosLink" href="<?php echo get_page_link(get_page_by_title('Blog')->ID);?>">Blog</a><!-- Parte de blog --> 
                     <a class="nav-link tresLink" href="<?php echo get_page_link(get_page_by_title('Activities')->ID);?>">Activities</a><!-- Parte de blog --> 
                </ol>
            </nav>
        </div>
        
     <div class="postDestacado imgGenericoFlex" style="background-image:url('<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0] ?>');">
               
              <div class="cajaPostDestacado">
                    <div class="cabeceraPostDestacado">
                        <div class="tipoPost flexCentrado">
                            <p><?php echo getPrimerasCategorias($mis_categorias);?></p>
                        </div>

                        <div class="flexCentrado botones">
                          <a href="#"><img src="<?php bloginfo('template_url'); ?>/img/left-arrow.png"></img></a>
                            <a href="#"><img src="<?php bloginfo('template_url'); ?>/img/right-arrow.png"></img></a>
                        </div>
                    </div>
                    
                    <div class="contenidoPostDestacado">
                    <a href="<?php the_permalink();?>">  
                        <div class="postDestacadoTitulo">
                            <h2> <?php echo the_title();?> </h2>
                        </div>
                    </a>  
                    
                        <div class="postDestacadoInfoAutor">
                           <span class="fotoPostDestacado"></span> 
                           <span class="info"><?php the_author();?></span>
                           <span class="info"> 
                                   <ol class="infoPost">
                                          <li> 
                                                    <span class="fa fa-calendar"></span>
                                          <?php 
                                                $args = array(
                                                    'format' => 'custom',
                                                    'before' => '<span class="hvr-forward">Posted: ',
                                                    'after' => '</span>');
                                                wp_get_archives($args);?>
                                             
                                          </li>
                                    </ol>
                    
                        </span>
                  
                        </div>
                        
                        <div class="postDestacadoExcerpt">
                           <?php echo the_excerpt();?>
                        </div>
                        
                        <div class="readMore">
                             <a href="<?php the_permalink();?>"> <h3>Read More</h3></a>
                        </div>
                    </div>
                  
                </div> 
      
      </div>
          
          <div class="separador">
          </div>
         <div class="containerPosts">
            
<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
            <?php
                $post_destacado_ID = $post->ID;

            }

                    }

                /*SEGUNDO LOOP PARA SACAR EL RESTO DE POSTS*/
  //Obtiene la variable GLOBAl page $page tiene la cantidad de paginas si existe sino te diceq ue solo hay 1 pagina
                    $paged= get_query_var('paged') ? get_query_var('paged') : 1;
                    $args =array(
                        'orderby'=>'date',
                        'post_type'=>array('post','nz_excursions'),//nz_excursion son los custom post que tu tengas ej cars_post
                        'post__not_in'=>array($post_destacado_ID),
                        'post_per_page'=>3,
                        'paged'=>$paged
                    );
            
                $custom_query = new WP_Query($args);
                if($custom_query->have_posts()) {
                    while($custom_query->have_posts()){
                        $custom_query->the_post(); 


            ?>
            <?php get_template_part('template-part/content',get_post_format());

                    }
                        }
             ?>
                
</div>
<div class="front-page"></div>
 <?php get_footer();?>
</html>
</div>