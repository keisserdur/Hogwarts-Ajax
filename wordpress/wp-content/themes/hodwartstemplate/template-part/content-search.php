<?php
if ($post->post_type != 'page') {
        echo '<i class="fa fa-th" aria-hidden="true"></i>';
        the_author(); 
 
} else {
   echo '<span class="fa fa-desktop">&nbsp;</span>'; 
}
?>
<?php
    if ($post->post_type != 'page') {
        the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' );
        the_excerpt();
    } else {
        the_title();
        echo '<span> Page </span>';
    }
?>
