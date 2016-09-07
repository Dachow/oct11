<?php

//Register Nav Menus
register_nav_menus(array('header-menu' => __('Damien-Menu')));

/**
 * 加载外部脚本
 * https://chon.io/blog/wordpress-enqueue-scripts-and-styles/
 * array()处理加载依赖问题，bootstrap依赖于jquery，不指定array，页头加载bootstrap，页尾加载jquery，则无法正常工作
 * 指定array可解决这个问题.
 */
function my_enqueue_scripts()
{
    if (!is_admin()) { // 前台加载的脚本与样式表
        // 去除已注册的 jquery 脚本
        wp_deregister_script('jquery');
        // 注册 jquery 脚本
        wp_register_script('jquery', get_template_directory_uri().'/assets/js/jquery.min.js', array(), $vaer = '3.1.0', true);
        // 提交加载 jquery 脚本
        wp_enqueue_script('jquery');
        // 注册 bootstrap 脚本
        wp_register_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), '3.3.7', true);
        // 提交加载 bootstrap 脚本
        wp_enqueue_script('bootstrap');
        // 注册 自己的 脚本
        wp_register_script('script', get_template_directory_uri().'/assets/js/script.js', array('jquery'), '1.0', true);
        // 提交加载 bootstrap 脚本
        wp_enqueue_script('script');
    } else { // 后台加载的脚本与样式表
        // 取消加载 jquery 脚本
        wp_dequeue_script('jquery');
        // 注册并加载 jquery 脚本
        wp_enqueue_script('jquery', get_template_directory_uri().'/assets/js/jquery.js', array(), '', true);
    }
}
// 添加回调函数到 init 动作上
add_action('init', 'my_enqueue_scripts');

// 更改二級导航的类名
class Sub_Nav_Menu extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }
}

// 小工具

// 浏览次数统计
function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');

        return '0 View';
    }

    return $count.' Views';
}
function setPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        ++$count;
        update_post_meta($postID, $count_key, $count);
    }
}

/**
 * WordPress 添加面包屑导航
 * http://www.wpdaxue.com/wordpress-add-a-breadcrumb.html.
 */
function cmp_breadcrumbs()
{
    $delimiter = '/'; // 分隔符
    $before = '<span class="current">'; // 在当前链接前插入
    $after = '</span>'; // 在当前链接后插入
    if (!is_home() && !is_front_page() || is_paged()) {
        echo '<div itemscope itemtype="http://schema.org/WebPage" id="crumbs">'.__('You are here:', 'cmp');
        global $post;
        $homeLink = home_url();
        echo ' <a itemprop="breadcrumb" href="'.$homeLink.'">'.__('Home', 'cmp').'</a> '.$delimiter.' ';
        if (is_category()) { // 分类 存档
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) {
                $cat_code = get_category_parents($parentCat, true, ' '.$delimiter.' ');
                echo $cat_code = str_replace('<a', '<a itemprop="breadcrumb"', $cat_code);
            }
            echo $before.''.single_cat_title('', false).''.$after;
        } elseif (is_day()) { // 天 存档
            echo '<a itemprop="breadcrumb" href="'.get_year_link(get_the_time('Y')).'">'.get_the_time('Y').'</a> '.$delimiter.' ';
            echo '<a itemprop="breadcrumb"  href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_time('F').'</a> '.$delimiter.' ';
            echo $before.get_the_time('d').$after;
        } elseif (is_month()) { // 月 存档
            echo '<a itemprop="breadcrumb" href="'.get_year_link(get_the_time('Y')).'">'.get_the_time('Y').'</a> '.$delimiter.' ';
            echo $before.get_the_time('F').$after;
        } elseif (is_year()) { // 年 存档
            echo $before.get_the_time('Y').$after;
        } elseif (is_single() && !is_attachment()) { // 文章
            if (get_post_type() != 'post') { // 自定义文章类型
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a itemprop="breadcrumb" href="'.$homeLink.'/'.$slug['slug'].'/">'.$post_type->labels->singular_name.'</a> '.$delimiter.' ';
                echo $before.get_the_title().$after;
            } else { // 文章 post
                $cat = get_the_category();
                $cat = $cat[0];
                $cat_code = get_category_parents($cat, true, ' '.$delimiter.' ');
                echo $cat_code = str_replace('<a', '<a itemprop="breadcrumb"', $cat_code);
                echo $before.get_the_title().$after;
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            echo $before.$post_type->labels->singular_name.$after;
        } elseif (is_attachment()) { // 附件
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo '<a itemprop="breadcrumb" href="'.get_permalink($parent).'">'.$parent->post_title.'</a> '.$delimiter.' ';
            echo $before.get_the_title().$after;
        } elseif (is_page() && !$post->post_parent) { // 页面
            echo $before.get_the_title().$after;
        } elseif (is_page() && $post->post_parent) { // 父级页面
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a itemprop="breadcrumb" href="'.get_permalink($page->ID).'">'.get_the_title($page->ID).'</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo $crumb.' '.$delimiter.' ';
            }
            echo $before.get_the_title().$after;
        } elseif (is_search()) { // 搜索结果
            echo $before;
            printf(__('Search Results for: %s', 'cmp'),  get_search_query());
            echo  $after;
        } elseif (is_tag()) { //标签 存档
            echo $before;
            printf(__('Tag Archives: %s', 'cmp'), single_tag_title('', false));
            echo  $after;
        } elseif (is_author()) { // 作者存档
            global $author;
            $userdata = get_userdata($author);
            echo $before;
            printf(__('Author Archives: %s', 'cmp'),  $userdata->display_name);
            echo  $after;
        } elseif (is_404()) { // 404 页面
            echo $before;
            _e('Not Found', 'cmp');
            echo  $after;
        }
        if (get_query_var('paged')) { // 分页
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo sprintf(__('( Page %s )', 'cmp'), get_query_var('paged'));
            }
        }
        echo '</div>';
    }
}

?>
