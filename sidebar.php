   <!-- Column 2 / Sidebar -->
    <div class="sidebar-page">
        
    <?php if ( !function_exists('dynamic_sidebar') 
                        || !dynamic_sidebar('First_sidebar') ) : ?>
<div class="panel panel-info cats">
  <div class="panel-heading"><h4 class="panel-title">分类目录</h4></div>
  <ul class="panel-body">
    <?php wp_list_categories('depth=0&title_li=&orderby=id&show_count=1&hide_empty=0&child_of=0'); ?>
  </ul>
</div>
    <?php endif; ?>
        

    <?php if ( !function_exists('dynamic_sidebar') 
                            || !dynamic_sidebar('Second_sidebar') ) : ?>


<div class="panel panel-success news">
  <div class="panel-heading">
    <h4 class="panel-title">最新文章</h4>
  </div>
  <ul class="panel-body">
    <?php
                $posts = get_posts('numberposts=7&orderby=post_date');
                foreach($posts as $post) {
                    setup_postdata($post);
                    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                }
                $post = $posts[0];
            ?>
  </ul>
</div>
    <?php endif; ?>
    

    <?php if ( !function_exists('dynamic_sidebar') 
                            || !dynamic_sidebar('Third_sidebar') ) : ?> 

<div class="panel panel-warning labels">
  <div class="panel-heading">
    <h4 class="panel-title">标签云</h4>
  </div>
  <div class="panel-body">
    <?php wp_tag_cloud('smallest=8&largest=22'); ?>
  </div>
</div>
    <?php endif; ?>
        

    <?php if ( !function_exists('dynamic_sidebar') 
                        || !dynamic_sidebar('Fourth_sidebar') ) : ?>                    
<div class="panel panel-danger arcs">
  <div class="panel-heading">
    <h4 class="panel-title">文章存档</h4>
  </div>
  <ul class="panel-body">
    <?php wp_get_archives('limit=12&show_post_count=true'); ?>
  </ul>
</div>
    <?php endif; ?>
    
    </div>