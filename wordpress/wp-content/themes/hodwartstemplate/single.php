<?php 
    get_header();
    the_post();
    $currentID = $post->ID;
?>
<article class="single-body">
    <div class="default">
    <?php get_template_part('template-part/nav');?>
    </div>
    
    <section style="background-image : url('<?php echo getUrlThumbnail($post->ID) ?>')"  class="single-header">
        <div class="single-filter"></div>
        <h1 class="single-title"><?php the_title(); ?></h1>
    </section>
    
    <section class="single-content">
        <div class="single-content-text">
            <div class="single-otro-contenedor">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
    <div class="single-share">
        <div class="single-social-share-page__heading">
            <h2>SHARE THIS PAGE</h2>
        </div>
        <div class="single-medias">
            <div class="single-medias-content">
                <a href="#"><span class="fa fa-facebook"></span></a>
                <a href="#"><span class="fa fa-twitter"></span></a>
                <a href="#"><span class="fa fa-google-plus"></span></a>
            </div>
            <div class="single-medias-content">
                <a href="#"><span class="fa fa-twitter"></span></a>
                <a href="#"><span class="fa fa-envelope"></span></a>
                <a href="#"><span class="fa fa-instagram"></span></a>
            </div>
        </div>
    </div>
    
    <section class="single-topics">
        <div class="single-topics-content">
            <h1>Related topics by category</h1>
            
            <div class="single-cat-loop">
                <?php 
                    $slug_first_cat = get_the_category()[0]->slug;
                    $arg = array( 'post_count' => 3,
                                    'post__not_in' => array($currentID));
                    if($slug_first_cat){
                        $arg['category_name'] = $slug_first_cat;
                    }
                ?>
                    <hr>
                <?php  
                    $wp_query = new WP_Query($arg);
                    if ( $wp_query->have_posts() ) {
                    	while ( $wp_query->have_posts() ) {
                     		the_post(); 
                     		
         		?>    
         		            <a href="<?php echo get_permalink() ?>">
                     		    <div class="single-inside-mini-loop">
                                    <img class="single-more-topics" alt="" src="<?php echo getUrlThumbnail($post->ID) ?>">            		
         		<?php
                    		
                     		        echo '<h5>';the_title();echo '</h5>';
         		?>
     		                    </div>
     		                </a>
         		<?php
                    		
                    	} // end while
                    } // end if
                
                ?>
            </div>
            
        </div>
        
    </section>
</article>
<div class="front-page">
    <?php get_footer(); ?>
</div>
    

