<?php
/**
 *
 * @package WordPress
 * @subpackage APACN
 * @since APACN 1.0
 */

	//Habilitando Thumbs
	add_theme_support('post-thumbnails', array('post', 'page', 'unidades', 'parceiros', 'produtos'));

    // Habilitando resumo nas páginas
    add_action( 'init', 'my_add_excerpts_to_pages' );
    function my_add_excerpts_to_pages() {
         add_post_type_support( 'page', 'excerpt' );
    }

	//Return page active
	function check($slug, $page){
    	$active = "";
        if($slug == $page){
        	echo $active = 'class="active"';
		}else{
        	echo $active = '';
        }
	}
  
  
	add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
	add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

	function remove_thumbnail_dimensions( $html ) {
	    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	    return $html;
  }
  
  function to_permalink($str)
  {
    if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
      $str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
    $str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
    $str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
    $str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
    $str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
    $str = strtolower( trim($str, '-') );
    return $str;
  }

	function cwp_register_taxonomy_lojinha(){
     register_taxonomy(
          'lojinha',
          'produtos',
          array(
               'label' => __('Lojinha'),
               'rewrite' => array('slug' => lojinha),
               'hierarchical' => true
          )
     );
}
add_action('init', 'cwp_register_taxonomy_lojinha');

function apacn_scripts() {
    wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.min.css', array() );

    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', false, '3.1.1');
    wp_enqueue_script('jquery');

    wp_register_script( 'js', get_template_directory_uri().'/assets/js/js.min.js', array( 'jquery' ), true );
    wp_enqueue_script( 'js' );
}
add_action( 'wp_enqueue_scripts', 'apacn_scripts' );

function excerpt($limit){
  
  $excerpt = wp_strip_all_tags(get_the_content());
  $excerpt_length = strlen($excerpt);

  if( $limit < $excerpt_length ){
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = $excerpt.'...';
  }

  //$excerpt = preg_replace(" ([.*?])",'',$excerpt);
  //$excerpt = strip_shortcodes($excerpt);
  //$excerpt = strip_tags($excerpt);
  //$excerpt = substr($excerpt, 0, $limit);
  //$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  //$excerpt = trim(preg_replace( '/s+/', ' ', $excerpt));
  //$excerpt = $excerpt.'...';

  return $excerpt;
}

function addhttp($url) {
  if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
      $url = "http://" . $url;
  }
  return $url;
}

function wp_custom_breadcrumbs() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '>'; // delimiter between crumbs
  $home = 'HOME'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="Breadcrumb__item--active">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = get_bloginfo('url');
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<div class="Breadcrumb"><a href="' . $homeLink . '">' . $home . '</a></div>';
 
  } else {
 
    echo '<div class="Breadcrumb"><span class="Breadcrumb__item">VOCÊ ESTÁ EM: <a href="' . $homeLink . '">' . $home . '</a>' . $delimiter . '</span>';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'categoria "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'RESULTADOS PARA: "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<span class="Breadcrumb__item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' </span>';
      echo '<span class="Breadcrumb__item"><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' </span>';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<span class="Breadcrumb__item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . '</span>';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<span class="Breadcrumb__item"><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' . $delimiter . '</span>';
        if ($showCurrent == 1) echo ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, FALSE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo'<span class="Breadcrumb__item">' . $cats . '</span>';
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<span class="Breadcrumb__item"><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>'. $delimiter .'</span>';
      if ($showCurrent == 1) echo ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<span class="Breadcrumb__item"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>'. $delimiter . '</span>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo '<span class="Breadcrumb__item">'. $delimiter .__(' Página') . ' ' . get_query_var('paged').'</span>';
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} // end wp_custom_breadcrumbs()

// Pagination
function wp_pagination($pages = '', $range = 9)
{  
    global $wp_query, $wp_rewrite;  
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;  
    $pagination = array(  
        'base' => @add_query_arg('page','%#%'),  
        'format' => '',  
        'total' => $wp_query->max_num_pages,  
        'current' => $current,  
        'show_all' => true,  
        'type' => 'plain'  
    );  
    if ( $wp_rewrite->using_permalinks() ) $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );  
    if ( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );  
    echo '<div class="wp_pagination">'.paginate_links( $pagination ).'</div>';

    print_r($pagination);
}

function change_submenu_class($menu) {  
  $menu = preg_replace('/ class="sub-menu"/','/ class="Menu-sub" /',$menu);
  //echo $menu;
  return $menu;  
}  
add_filter('wp_nav_menu','change_submenu_class'); 

function filter_ptags_on_images($content) {
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

function is_active($Location, $Select, $Class){

    if($Location == $Select){
        echo $Class;
    } else {
        echo '';
    }

}




function get_custom_cat_template($single_template) {
   global $post;
   if ( in_category( array(2, 3) ) ) {
      $single_template = dirname( __FILE__ ) . '/template-parts/single-evento-campanha.php';
   }
  //  elseif ( in_category( array(2, 3) ) ) {
  //     $single_template = dirname( __FILE__ ) . '/template-parts/single-evento-campanha.php';
  //  }
  return $single_template;
} 
add_filter( "single_template", "get_custom_cat_template" ) ;




function pagination( $pages = "", $url, $Num, $numlinks = 2){

    $qtde = ($numlinks * 2)+1;

    //global $paged;
    //if(empty($paged)) $atual = 1; else $atual = $paged;
    
    if($pages == ""){
        global $wp_query;
        //$wp_query = new WP_Query( $args );
        //$wp_query = query_posts($args);
        //$wp_query->set('posts_per_page', '-1');
        //$wp_query = query_posts($args, 'posts_per_page', '-1');        
        
        $paginas = $wp_query->max_num_pages;

        if(!$pages){
            $pages = 1;
        } 
        
    }    

    $url = get_site_url().$url;

    if($pages != 1){
        echo '<div class="Pagination">';
        echo '<ul>';

        // if($atual > 2 && $atual > $numlinks + 1 && $qtde < $pages){
        //     echo '<li><a href="'.get_pagenum_link(1).'" title="Anterior"><span class="i-Prev"></span></a></li>';
        // }
        //echo '<li><a href="'.get_pagenum_link(1).'" title="Anterior"><span class="i-Prev"></span></a></li>';
        echo '<li><a href="'.$url.'&page=1'.'" title="Anterior"><span class="i-Prev"></span></a></li>';

        for ($i=1; $i <= $pages; $i++){
            if (1 != $pages &&( !($i >= $Num + $Num + 1 || $i <= $Num - $Num - 1) || $pages <= $qtde )){
                //echo ($atual == $i)? '<li><a href="#" title="1" class="is-Current">1</a></li>' : '<li><a href="'.get_pagenum_link($i).'" title="'.$i.'">'.$i.'</a></li>';                
                echo ($Num == $i)? '<li><a href="#" title="'.$i.'" class="is-Current">'.$i.'</a></li>' : '<li><a href="'.$url.'&page='.$i.'" title="'.$i.'">'.$i.'</a></li>';                
            }
        }

        // if($atual < $pages - 1 && $atual + $numlinks - 1 < $pages && $qtde < $pages){
        //     echo '<li><a href="'.get_pagenum_link($pages).'" title="Próximo"><span class="i-Next"></span></a></li>';
        // }
        
        //echo '<li><a href="'.get_pagenum_link($pages).'" title="Próximo"><span class="i-Next"></span></a></li>';
        echo '<li><a href="'.$url.'&page='.$pages.'" title="Próximo"><span class="i-Next"></span></a></li>';
        
        //if($atual > 2 && $atual > $numlinks + 1 && $qtde < $pages) echo '<a href="'.get_pagenum_link(1).'">&laquo; Primeira</a>';
        //if($atual > 1 && $qtde < $pages) echo '<a href="'.get_pagenum_link($atual – 1).'">&laquo;</a>';

        // for ($i=1; $i <= $pages; $i++){
        //     if (1 != $pages &&( !($i >= $atual + $numlinks + 1 || $i <= $atual – $numlinks – 1) || $pages <= $qtde )){
        //         echo ($atual == $i)? '<span class="atual">'.$i.'</span>":"<a href="'.get_pagenum_link($i).'" class="inactive" >'.$i.'</a>';
        //     }
        // }


        echo '</ul>';
        echo '</div>';        
			
    }

}


function anti_injection($sql) {
	$sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/i","",$sql);
    $sql = trim($sql);
    $sql = strip_tags($sql);
    $sql = preg_replace ("/(\"|\')/", "", $sql);
    $sql = addslashes($sql);
    return $sql;
} 