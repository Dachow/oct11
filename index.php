<?php get_header() ?>

<!-- 文章内容开始 -->
      <div class="container index-page">
      <div class="row">
      <!--section left-->
      <section class="col-sm-9 left">
        <!-- The Query  -->
        <?php
        $args = array(
            // 不显示轮播图分类下的文章，分类ID为5
            // 'category__not_in' => array(5),
        );
         ?>
         <!-- 自定义模板需要使用query_posts查询 -->
        <?php 
            // 一定要注释php标签里面的语句，连同php标签一起用html注释无效
            // query_posts($args);
         ?>
         <?php $the_query = new WP_Query( ); ?>
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
      <?php endwhile; ?>

      <!-- Blog Navigation -->
     <p class="more-posts">
     <span class="previous pull-left"><?php next_posts_link('&lt;&lt; previous', 0); ?></span>
     <span class="next pull-right"><?php previous_posts_link('next &gt;&gt;', 0); ?></span>
     </p>
     
     <?php else : ?>
     <p><?php _e('Sorry, no posts matched in this site.'); ?></p>
    
    <?php endif; ?>

        <!-- Reset Query  -->
        <!-- <?php wp_reset_query(); ?> -->
        </section>

        <!-- section right-->
        <section class="col-sm-3 right">
            <?php get_sidebar(); ?>
        </section>

        
</div>
        </div>
<!-- 文章内容结束 -->
<?php get_footer(); ?>
