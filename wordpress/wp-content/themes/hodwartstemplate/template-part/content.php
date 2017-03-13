 
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