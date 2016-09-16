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
    $getHref = $_SERVER["QUERY_STRING"];
    if(preg_match('/\d+/', $getHref, $arr)){
        $cat_ID = $arr[0];
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
    <?php query_posts("showposts=15&cat=$cat_ID"); echo $getCatID; ?>
    <!-- 根据需要修改文章数量和分类目录的ID -->
    <?php while (have_posts()) : the_post(); ?>
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
    <?php wp_reset_query(); ?>
    </ul>
</div>
</div>


<?php get_footer(); ?>
