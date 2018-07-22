<?php
/* custom header in post page */
function my_theme_enqueue_styles() {
    $parent_style = 'parent_style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

/* Gaotai Divi Theme Setup */
function GaotaiDiviTheme_setup() {
	// Add post format support
	add_theme_support('post-formats', array('chat', 'link', 'aside', 'image', 'video', 'gallery'));
	// Divi child theme 中文化
	load_child_theme_textdomain('Divi', get_stylesheet_directory().'/lang');
	load_child_theme_textdomain('et_builder', get_stylesheet_directory().'/includes/builder/languages');
}
add_action('after_setup_theme', 'gaotaiDiviTheme_setup', 15);

/* 把指定的 JavaScript 檔加入 async 或 defer 屬性 */
function defer_js_async($tag){

  /* 要加入 defer 屬性的 JavaScript 檔 */
  $scripts_to_defer = array();

  /* 要加入 async 屬性的 JavaScript 檔 */
  $scripts_to_async = array('Divi');

  /* 處理 defer */
  foreach($scripts_to_defer as $defer_script){
    if(true == strpos($tag, $defer_script ) )
      return str_replace( ' src', ' defer="defer" src', $tag );
  }
  /* 處理 async */
  foreach($scripts_to_async as $async_script){
    if(true == strpos($tag, $async_script ) )
      return str_replace( ' src', ' async="async" src', $tag );
  }
  return $tag;
}
add_filter( 'script_loader_tag', 'defer_js_async', 10 );
?>