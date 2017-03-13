<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet">
        
        <title>
            <?php 
            
                if (function_exists('is_tag') && is_tag()) {
                     single_tag_title('Tag Archive for &quot;'); echo '&quot; - ';
                 } elseif (is_archive()) {
                     wp_title(''); echo ' Archive - ';
                 } elseif (is_search()) {
                     echo 'Search for &quot;'.wp_specialchars($s).'&quot; - ';
                 } elseif (!(is_404()) && (is_single()) || (is_page())) {
                     wp_title(''); echo ' - ';
                 } elseif (is_404()) {
                     echo 'Not Found - ';
                }
                
                if (is_home()) {
                         bloginfo('name'); echo ' - '; bloginfo('description');
                } else {
                         bloginfo('name');
                }
                 if ($paged > 1) {
                     echo ' - page '. $paged;
                } 
            ?>
        </title>

        <?php
            wp_head();
        ?>
    </head>
    <body>