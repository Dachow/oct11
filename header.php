<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title>
        <?php wp_title( '|', true, 'right' ); ?>
    </title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
 <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
 <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

  <!-- 使style.css中引入的外部css有用 -->
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- 导航开始 -->
    <header class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <!-- collapse触发移动端导航图标 -->
                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" class="navbar-brand">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </div>


<!-- 自定义菜单 -->
<?php wp_nav_menu( array( 'theme_location'=> 'header-menu', 'container'=>'nav', 'container_class' => 'collapse navbar-collapse', 'menu_class'=>'nav navbar-nav', 'depth'=>'1') );
?>


        </div>
    </header>
    <!-- 导航结束 -->

    <!-- 正文开始 -->
    <div class="content">
