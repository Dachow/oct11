<?php get_header() ?>

<div class="container category-page">

  <!-- 显示当前页面文章分类名及文章数目 -->
  <div class="category-name">
  <ul class="list-group">
  <li class="list-group-item">


<?php
// old
/*
foreach ((get_the_category()) as $category) {
$getCatID = $category->cat_ID.' ';
    echo $category->cat_name.' ';
// echo $category->category_nicename . ' ';
// echo $category->category_description . ' ';
// echo $category->category_parent . ' ';
$getCount = $category->category_count.' ';
}
*/
?>

<?php
//   从url获取文章分类id的方法;
    $getHref = $_SERVER['PHP_SELF'];
    echo $getHref;
    if(preg_match('/(?<=[t][a][g][=]).*/', $getHref, $arr)){
        $cat_ID = $arr[0];
        // echo $cat_ID;
    }

    single_cat_title();
    // 获取分类及子分类文章数目
    $getCount = get_cat_postcount_all($cat_ID);
?>

<span class="badge"><?php echo $getCount; ?></span>
  </li>
</ul>
</div>

<!-- 列出当前分类文章 -->
<div class="category-posts">
  <ul class="list-group">
   <!-- WP_Query用法 -->
    <?php $the_query = new WP_Query( "showposts=15&cat=$cat_ID&paged=".$paged); ?>
    <!-- 根据需要修改文章数量和分类目录的ID -->
    <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <?php $getTitleLen = get_the_title(); ?>
        <li class="list-group-item">
            <?php if($getTitleLen) : ?>
                <!-- 标题的长度不为0时 -->
                <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
            <?php else : ?>
                <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo "无标题"; ?></a>
            <?php endif; ?>
            <span class="pull-right">
                <?php the_time('Y-m-d'); ?>
            </span>
        </li>
    <?php endwhile; ?>

      <!-- Blog Navigation -->
     <p class="more-posts">
     <span class="previous pull-left"><?php next_posts_link('&lt;&lt; previous', 0); ?></span>
     <span class="next pull-right"><?php previous_posts_link('next &gt;&gt;', 0); ?></span>
     </p>

     <?php else : ?>
     <p><?php _e('Sorry, no posts matched in this category.'); ?></p>
    
    <?php endif; ?>

    </ul>
</div>
</div>


<?php get_footer(); ?>
