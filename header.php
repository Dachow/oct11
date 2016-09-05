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
    <!-- 设置标题 -->
    <title>
      <?php
        global $page, $paged;
        $site_description = get_bloginfo( 'description', 'display' );
        if ($site_description && ( is_home() || is_front_page() )) {
          bloginfo('name');
          echo " - $site_description";
        } else {
          echo trim(wp_title('',0));
          if ( $paged >= 2 || $page >= 2 )
            echo ' - ' . sprintf( __( '第%s页' ), max( $paged, $page ) );
          echo ' | ' ;
          bloginfo('name');
        }
      ?>
    </title>
    <!-- 设置标题结束 -->

    <!-- 设置关键词、描述 -->
    <?php if (is_home() || is_front_page())
      {
        $description = get_option( 'zan_description' );
        $keywords = get_option( 'zan_keywords' );
      }
      elseif (is_category())
      {
        $description = strip_tags(trim(category_description()));
        $keywords = single_cat_title('', false);
      }
      elseif (is_tag())
      {
        $description = sprintf( __( '与标签 %s 相关联的文章列表'), single_tag_title('', false));
        $keywords = single_tag_title('', false);
      }
      elseif (is_single())
      {
        if ($post->post_excerpt) {$description = $post->post_excerpt;}
        else {$description = mb_strimwidth(strip_tags($post->post_content),0,110,"");}
        $keywords = "";
        $tags = wp_get_post_tags($post->ID);
        foreach ($tags as $tag ) {$keywords = $keywords . $tag->name . ", ";}
      }
      else
      {
        $description = get_option( 'zan_description' );
        $keywords = get_option( 'zan_keywords' );
      }
    ?>
    <!-- 设置关键词、描述结束 -->

    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta content="<?php echo trim($description); ?>" name="description"/>
    <meta content="<?php echo rtrim($keywords,','); ?>" name="keywords"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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


<!-- 自定义菜单, 仍需写出子菜单的触发事件 -->
<?php
  $defaults = array(
    'theme_location' => 'header-menu',
    'container' => 'nav',
    'container_class' => 'collapse navbar-collapse',
    'menu_class' => 'nav navbar-nav',
    'depth' => '2',
    'walker' => new Sub_Nav_Menu('')
  );
  wp_nav_menu($defaults);
?>

        </div>
    </header>
    <!-- 导航结束 -->

    <!-- 正文开始 -->
    <div class="content">
