<?php

//Register Nav Menus
register_nav_menus(array('header-menu' => __( 'Damien-Menu' ),));


/**
 * 加载外部脚本
 * https://chon.io/blog/wordpress-enqueue-scripts-and-styles/
 * array()处理加载依赖问题，bootstrap依赖于jquery，不指定array，页头加载bootstrap，页尾加载jquery，则无法正常工作
 * 指定array可解决这个问题
 */
function my_enqueue_scripts() {
    if( ! is_admin() ) { // 前台加载的脚本与样式表
        // 去除已注册的 jquery 脚本
        wp_deregister_script( 'jquery' );
        // 注册 jquery 脚本
        wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), $vaer = '3.1.0', true );
        // 提交加载 jquery 脚本
        wp_enqueue_script( 'jquery' );
        // 注册 bootstrap 脚本
        wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
        // 提交加载 bootstrap 脚本
        wp_enqueue_script( 'bootstrap' );
        // 注册 自己的 脚本
        wp_register_script( 'script', get_template_directory_uri() . '/assets/js/script.js', array( 'jquery' ), '1.0', true );
        // 提交加载 bootstrap 脚本
        wp_enqueue_script( 'script' );


    } else { // 后台加载的脚本与样式表
        // 取消加载 jquery 脚本
        wp_dequeue_script( 'jquery' );
        // 注册并加载 jquery 脚本
        wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.js', array(), '', true );
    }
}
// 添加回调函数到 init 动作上
add_action( 'init', 'my_enqueue_scripts' );

// 更改二級导航的类名
class Sub_Nav_Menu extends Walker_Nav_Menu {

  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent  = str_repeat( "\t", $depth );
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }
}

// 小工具


 ?>
