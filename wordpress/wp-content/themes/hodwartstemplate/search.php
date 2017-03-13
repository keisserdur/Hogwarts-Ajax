<?php
    get_header(); 
?>
<div class="search">
    <div class="img-background">
        <div class="blank-shadow">
            <?php get_template_part( 'template-part/nav' ); ?>
            <div class="container-hs">
                <?php
                    echo '<h1 class="h1">';
                    if ( have_posts() ) { 
                        $total_results = $wp_the_query->post_count;
                        if ( $total_results > 1) {
                            echo $total_results." POSTS";
                        }else{
                            echo $total_results." POST";
                        };
                    }else{
                        echo "NO POST";
                    }
                    echo '&nbsp;</h1>';
                ?>              
                <h2 class="h2">FOUND</h2>
            </div>
        </div>
    </div>
    
    <?php if ( have_posts() ) : ?>
        <h2><?php printf( __( 'Search Results for: %s' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
    
    <?php
    echo '<div class="container-search-post">';
    while ( have_posts() ) : the_post(); 
    
    get_template_part('template-part/content', 'search'); 
    
    endwhile;
    echo '</div>';
    
    else :
    get_template_part( 'template-parts/content', 'none' );
    
    endif;
    ?>
    <div class="front-page"></div>
</div>
<?php 
get_footer(); 
?>