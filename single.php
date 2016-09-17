<?php get_header() ?>

        <div class="container single-page">

          <div class="path">
            <ol class="breadcrumb">
              <!-- 插入面包屑导航 -->
<?php if (function_exists('cmp_breadcrumbs')) {
    cmp_breadcrumbs();
} ?>
</ol>
          </div>

    <?php while (have_posts()) : the_post(); ?>
      <div class="panel panel-default">
        <div class="panel-heading">
        <h2>
            <?php
            // 文章标题不存在时显示无标题
            $getTitleLen = get_the_title();
            if($getTitleLen) {
                the_title();
            } else {
                echo "无标题";
            }
            ?>
        </h2>
    </div>
        <div class="panel-footer">
        <?php edit_post_link('edit', '<span class="edit">', '</span>'); ?>
          <span class="date"><?php the_time(); ?></span>
          <span class="views">
            <!-- 获取浏览次数 -->
            <?php setPostViews(get_the_ID()); ?>
            <?php echo getPostViews(get_the_ID()); ?>
          </span>
        </div>
        <div class="panel-body">
<?php the_content(); ?>
 </div>
        </div>
    <?php endwhile; ?>


        </div>
<?php get_footer(); ?>
