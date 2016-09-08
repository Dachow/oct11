<?php get_header() ?>

<!-- 文章内容开始 -->
      <div class="container index-page">
<?php while ( have_posts() ) : the_post(); ?>
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
            </div>
        </section>
        <hr class="hr" />
<?php endwhile; ?>

        </div>
<!-- 文章内容结束 -->
<?php get_footer(); ?>
