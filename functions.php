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
        wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), $vaer = '3.1.0', false );
        // 提交加载 jquery 脚本
        wp_enqueue_script( 'jquery' );
        // 注册 bootstrap 脚本
        wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', false );
        // 提交加载 jquery-easing 脚本
        wp_enqueue_script( 'bootstrap' );


    } else { // 后台加载的脚本与样式表
        // 取消加载 jquery 脚本
        wp_dequeue_script( 'jquery' );
        // 注册并加载 jquery 脚本
        wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.js', array(), '', true );
    }
}
// 添加回调函数到 init 动作上
add_action( 'init', 'my_enqueue_scripts' );

 ?>
