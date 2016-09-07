<?php get_header() ?>

<!-- 文章内容开始 -->
      <div class="container">
<?php while ( have_posts() ) : the_post(); ?>
        <section class="<?php the_ID(); ?>">
            <h3 class="title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="content">
                <?php the_content(); ?>
            </div>
        </section>;
<?php endwhile; ?>

        </div>
<!-- 文章内容结束 -->
<?php get_footer(); ?>
