<?php get_header() ?>

<!-- 文章内容开始 -->
      <div class="container index-page">
        <!-- The Query  -->
        <?php
        $args = array(
            // 不显示轮播图分类下的文章，分类ID为5
            'category__not_in' => array(5),
        );
         ?>
         <!-- 自定义模板需要使用query_posts查询 -->
        <?php query_posts($args); ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <!-- 形成posts-ID的类名 -->
    <?php $getPostsID = get_the_ID(); ?>
    <section class="<?php echo "posts{$getPostsID}"; ?>">
            <h3 class="title">
                <i class="fa fa-tags" aria-hidden="true"></i>
                <a href="<?php the_permalink(); ?>">
                    <?php
                    // 文章标题不存在时显示无标题
                    $getTitleLen = get_the_title();
                    if($getTitleLen) {
                        the_title();
                    } else {
                        echo "无标题";
                    }
                    ?>
                </a>
            </h3>
            <div class="content">
                <?php the_excerpt(); ?>
                <div class="img"><?php don_the_thumbnail() ;?></div>
            </div>
        </section>
        <hr class="hr" />
      <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>
        <!-- Reset Query  -->
        <?php wp_reset_query(); ?>

        </div>
<!-- 文章内容结束 -->
<?php get_footer(); ?>
