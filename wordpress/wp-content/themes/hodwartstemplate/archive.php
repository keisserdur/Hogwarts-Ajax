<?php
/*
Template Name: Archive
*/
get_header(); ?>

    <body>
    
        <div class="fran archiveFran">
            <header class="myCarouselArchive slide" style="background-image:url('<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0] ?>');">
                <div class="fill" >
                    <div class="show">
                         <div>
                        <?php if(have_posts())
                            {
                            $total_results = $wp_the_query->post_count;
                            if($total_results > 1){
                                echo "Total Post find: ".$total_results;
                            }else{
                                echo "One Post find";
                            }
                         ;?>
                    </div>
                    <div>
                        <?php 
                            if(is_category())
                            {
                                printf(__('Category: %s', 'shape'), '<span>'.single_cat_title('', false).'...</span>');
                            }elseif(is_tag()){
                                printf(__('... Tag: %s', 'shape'), '<span>'.single_tag_title('', false).'...</span>');
                            }elseif(is_author()){
                                the_post();
                                printf(__('... Author: %s', 'shape'), '<span  class="vcard">'/*'<a class="url fn n" href="'.get_author_posts_url(get_the_author_meta("ID")).'"title='.esc_attr(get_the_author()).'" rel="me">'.get_the_author().'</a>*/ .wp_list_authors('show_fullname=1&include=' . get_the_author_id()).'...</span>');

                            rewind_posts();
                            }elseif(is_day()){
                                printf(__('... Dia: %s', 'shape'), '<span>' . get_the_date(). '... </span>');
                            }elseif(is_month()){
                                printf(__('... Mes: %s', 'shape'), '<span>' . get_the_date('F Y'). '... </span>');
                            }elseif(is_year()){
                                printf(__('... Año: %s', 'shape'), '<span>' . get_the_date('Y'). '... </span>');
                            }else{
                                _e('... Archives ...', 'shape');
                            }
                        };?>
                    </div>
    
                </div>
               </div>    
          
           </header>
    <?php get_template_part('template-part/nav');?>
   
             <div class="containerPosts">
                    <?php
                    while(have_posts()){ the_post();?>
                     <div class="post">
                <div class="imgGenericoFlex foto"  style="background-image:url('<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0] ?>');">
                </div>   
                <div class="infoPostGeneric">
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
                            <p><?php echo the_excerpt();?></p>
                        </div>
                        
                         
                        <div class="readMore">
                             <a href="<?php the_permalink();?>"> <h3>Read More</h3></a>
                        </div>
                  
                </div>
          </div>   
                    <?php }?>
                </div>
            </div>
        </div>
    </body>
   <div class="front-page"><?php get_footer(); ?></div>
