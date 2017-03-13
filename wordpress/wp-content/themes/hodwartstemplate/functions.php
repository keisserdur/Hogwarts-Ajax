<?php
    //Para saber en que archivo estamos
    add_action('wp_head', 'show_template');
    function show_template(){
        global $template;
        //print_r($template);
    }

    //Para crear post personalizados
    //require_once('template-parts/custompost.php');
    //require_once('template-parts/shortcode.php');


    //Para sacar una img y una leyenda ramdom
    function ramdon_full_width(){
        
        $img = array('foto1.jpg', 'foto2.jpg','foto3.jpg','foto4.jpg', 'foto4.jpg');
        $leyend = array('leyenda 1', 'leyenda 2','leyenda 3','leyenda 4', 'leyenda 5');
        
        $url = get_template_directory_uri() . '/assets/';
        
//        $pos = rand( 0 , count($img)-1 );
        $pos = random_int( 1 , count($img) )-1;
        
?>
        <div class="full-width">
            <figure>
                <img alt="" src="<?php echo $url . $img[$pos]; ?>">
                <figcaption><p><?php echo $leyend[$pos]; ?></p></figcaption>
            </figure>
        </div>

<?php

    }

    //Funcion que comprueba si tiene gravatar, devuelve true o false segun disponibilidad
    function has_gravatar($email){
        $hash = md5(strtolower(trim($email)));
        
        //Url base de gravatar
        $uri = 'http://www.gravatar.com/avatar/'. $hash . '?d=404';
        
        $headers = @get_headers($uri);
        
        if( !preg_match("|200|", $headers[0])){
            $has_valid_avatar = false;
        }else{
            $has_valid_avatar = true;
        }
        return $has_valid_avatar;
    }

    //Funcion que devuelve la url de la img del autor si la tiene o false
    function has_author_image($name){ 
        //Regex de para pasar de ruta absoluta a relativa
        $regex = '/http:\/\/localhost\/wp\//';
        $result = false;
        
        $formats = array ('.jpg', '.jpeg', '.png', '.svg', '.gif');
        
        foreach($formats as $val){
            //Url absoluta de la img con posibles formatos
            $url_img = get_template_directory_uri() . '/authorImg/' . $name . $val;
            //Sustituimos la parte inicial de la ruta para hacerla relativa
            if(file_exists(preg_replace($regex, './', $url_img) ) ){
                $result = $url_img;
            }
        }
        return $result;
    }

    //Para cambiar el simbolo de mas en el excerpt
    add_filter('excerpt_more','new_excerpt_more');
    function new_excerpt_more($more){
        global $post;
        return ' <a class="more" href="' . get_permalink($post->ID) . '">... Leer mas</a>';
    }     

    //Comprueba que este en el backend como administrador 
    if(!is_admin()){
        add_action('wp_enqueue_scripts','insetar_jquery_en_el_tema', 11);
    }      
    //Quitamos el jquery de wp para usar el de google, y asi evitar tener 2 jquerys
    function insetar_jquery_en_el_tema(){
        wp_deregister_script('jquery');
        //Operador ternario
        wp_register_script('jquery',"http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js", false, null);
        wp_enqueue_script('jquery');
    }


    //Para activar los plugin/widgets
    add_action('widgets_init', 'active_plugins');
    function active_plugins(){
        register_sidebar(array( 'name' => __('Sidebar default'),
                                'id' => 'sidebar',
                                'description' => __('Sidebar por defecto personalizado'),
                                'before_widget' => '<div class="widget %2$s">',
                                'after_widget' => '</div>'
                            
        ));
        
        register_sidebar(array( 'name' => __('Sidebar menu'),
                                'id' => 'sidebarmenu',
                                'description' => __('Sidebar por defecto personalizado para el menu'),
                                'before_widget' => '<div class="widget widget-menu %2$s">',
                                'after_widget' => '</div>'
                            
        ));
    }

    //Action hook para visualizar y editar camnpos personalizados en el backend de wp para usuarios
    add_action ('show_user_profile', 'add_custom_fields');
    add_action ('edit_user_profile', 'add_custom_fields');
    function add_custom_fields($user){
        ?>
            <h2>Redes Sociales</h2>
            <table class="form-table">
                <tr>
                    <th><label for="Facebook">Facebook</label></th>
                    <td>
                        <input type="text" id="Facebook" class="regular-text" value="<?php echo esc_attr (get_the_author_meta ('Facebook', $user->ID)); ?>" placeholder="Facebook" name="Facebook"/>
                        <br>
                        <span class="description">Facebook</span>
                    </td>                    
                </tr>
                <tr>
                    <th><label for="Twitter">Twitter</label></th>
                    <td>
                        <input type="text" id="Twitter" class="regular-text" value="<?php echo esc_attr (get_the_author_meta ('Twitter', $user->ID)); ?>"  placeholder="Twitter" name="Twitter"/>
                        <br>
                        <span class="description">Twitter</span>
                    </td>
                </tr>
            </table>

            <h2>Habilidades personales</h2>
            <table class="form-table">
                <tr>
                    <th><label for="skill1">Skill 1</label></th>
                    <td>
                        <input type="text" id="skill1" class="regular-text" value="<?php echo esc_attr (get_the_author_meta ('skill1', $user->ID)); ?>" placeholder="Nombre de la skill 1" name="skill1"/>
                        <br>
                        <span class="description">Primera skill del usuario</span>
                    </td>
                    <td>
                        <input type="text" id="valskill1" class="regular-text" value="<?php echo esc_attr (get_the_author_meta ('valskill1', $user->ID)); ?>" placeholder="Valor de la skill 1" name="valskill1"/>
                        <br>
                        <span class="description">Valor de la primera skill del usuario</span>
                    </td>
                </tr>
                
                <tr>
                    <th><label for="skill2">Skill 2</label></th>
                    <td>
                        <input type="text" id="skill2" class="regular-text" value="<?php echo esc_attr (get_the_author_meta ('skill2', $user->ID)); ?>" placeholder="Nombre de la skill 2" name="skill2"/>
                        <br>
                        <span class="description">Segunda skill del usuario</span>
                    </td>
                    <td>
                        <input type="text" id="valskill2" class="regular-text" value="<?php echo esc_attr (get_the_author_meta ('valskill2', $user->ID)); ?>" placeholder="Valor de la skill 2" name="valskill2"/>
                        <br>
                        <span class="description">Valor de la primera skill del usuario</span>
                    </td>
                </tr>
                
                <tr>
                    <th><label for="skill3">Skill 3</label></th>
                    <td>
                        <input type="text" id="skill3" class="regular-text" value="<?php echo esc_attr (get_the_author_meta ('skill3', $user->ID)); ?>" placeholder="Nombre de la skill 3" name="skill3"/>
                        <br>
                        <span class="description">Tercera skill del usuario</span>
                    </td>
                    <td>
                        <input type="text" id="valskill3" class="regular-text" value="<?php echo esc_attr (get_the_author_meta ('valskill3', $user->ID)); ?>" placeholder="Valor de la skill 3" name="valskill3"/>
                        <br>
                        <span class="description">Valor de la primera skill del usuario</span>
                    </td>
                </tr>
                
                <tr>
                    <th><label for="skill4">Skill 4</label></th>
                    <td>
                        <input type="text" id="skill4" class="regular-text" value="<?php echo esc_attr (get_the_author_meta ('skill4', $user->ID)); ?>" placeholder="Nombre de la skill 4" name="skill4"/>
                        <br>
                        <span class="description">Cuarta skill del usuario</span>
                    </td>
                    <td>
                        <input type="text" id="valskill4" class="regular-text" value="<?php echo esc_attr (get_the_author_meta ('valskill4', $user->ID)); ?>" placeholder="Valor de la skill 4" name="valskill4"/>
                        <br>
                        <span class="description">Valor de la primera skill del usuario</span>
                    </td>
                </tr>
                
            </table>

        <?php
    }
    
    //Para cuando poder guardar los campos personalizados
    add_action('personal_options_update', 'save_custom_fields');
    add_action('edit_user_profile_update', 'save_custom_fields');
    function save_custom_fields($user_id){
        if(!current_user_can('edit_user', $user_id))
            return false;
        
        //update_usermeta($user_id, 'color', $_POST['color']);
        update_usermeta($user_id, 'Facebook', $_POST['Facebook']);
        update_usermeta($user_id, 'Twitter', $_POST['Twitter']);
        
        update_usermeta($user_id, 'skill1', $_POST['skill1']);
        update_usermeta($user_id, 'skill2', $_POST['skill2']);
        update_usermeta($user_id, 'skill3', $_POST['skill3']);
        update_usermeta($user_id, 'skill4', $_POST['skill4']);
        
        update_usermeta($user_id, 'valskill1', $_POST['valskill1']);
        update_usermeta($user_id, 'valskill2', $_POST['valskill2']);
        update_usermeta($user_id, 'valskill3', $_POST['valskill3']);
        update_usermeta($user_id, 'valskill4', $_POST['valskill4']);
    }


    //Para añadir la clase responsive a las imagenes de los post
    add_filter ('the_content','add_responsive_class');
    function add_responsive_class($content){
        if($content){
            //Convertimos el contenido en una codificacion HTML en utf8
            $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');
            //Creamos un objeto de tipo DOM
            $document= new DOMDocument();
            //Desativamos los warming
            libxml_use_internal_errors(true);
            //Cargamos el html ya descodificado, porque falta parte del html y puede dar error
            $document->loadHTML(utf8_decode($content));
            //Obtenemos un array de img accediendo al DOM, como si fuese js
            $imgs = $document->getElementsByTagName('img');

            //Recorremos el array y le añadimos a las img la clase img-responsive
            //En este caso machacamos las demas clases, si se quiere evitar, deberiamos primero guardar
            //las clases ya existentes
            foreach($imgs as $valor){
                $valor->setAttribute('class','img-responsive');
            }


            //Para las imagenes con leyenda le quitamos al div el width
    //        $divs = $document->getElementsByClassName('wp-caption');

    //        foreach($divs as $valor){
    //            $valor->setAttribute('style','width: 100%');
    //        }

            //Guardamos el html ya guardado y lo devolvemos
            $html = $document->saveHTML();
            return $html;
        }
    }

    //Para añadir al temas post personalizados
    add_theme_support('post-formats', array ('video', 'audio', 'quote', 'image', 'gallery', 'link',' aside'));


    //Para añadir al tema que soporte imagenes destacadas
    add_theme_support('post-thumbnails');
    // Funcion para obtener las dos primeras categorias para el post destacado
    function getPrimerasCategorias ($categorias){
        $cadenaTratada = '';
        if(count($categorias) >= 2){
            $cadenaTratada = $categorias[0].' & '.$categorias[1];
        }elseif(count($categorias) == 1){
            $cadenaTratada = $categorias[0];
        }

        return $cadenaTratada;
    }

    //Obtine ruta de la img destacada del post
    function getUrlThumbnail($id, $size = 'small'){
        return wp_get_attachment_image_src(get_post_thumbnail_id($id), $size)[0];
    }


    //Funcion que trata la lista de pag que va a devolver cuando se llama a get_pages
    //para que el link inside the page funcione
    add_filter('get_pages', 'get_filtered_pages', 10, 2);
    function get_filtered_pages( $pages ) {
        if(!is_admin()){
            foreach ($pages as $pag){
                if ($pag -> post_title ==  'Cartelera'){
                    ?>
                    <li class="page-link">     
                        <a href="<?php echo get_settings('home'); ?>#Cartelera">
                        <?php echo $pag->post_title; ?>
                        </a>     
                    </li>
            <?php
                }elseif ($pag -> post_title ==  'Archives'){
                }else{
            ?>
                <li class="page-link">     
                    <a href="<?php echo get_page_link( $pag->ID ); ?>">
                    <?php echo $pag->post_title; ?>
                    </a>     
                </li>
        <?php
                }
            }
        }
        return $pages;
        
    }