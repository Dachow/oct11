<?php get_header() ?>

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

<?php get_footer(); ?>
