<?php
/*
* Template Name: slider-show
*/
?>
<?php get_header() ?>
<div class="container page-slider">

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
         <!-- The Query  -->
         <?php
         $args = array(
             // 显示轮播图分类下的文章，分类ID为5
             'category__in' => array(5),
         );
          ?>
          <!-- 自定义模板需要使用query_posts查询 -->
         <?php query_posts($args); ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <!-- 需在js中给第一个item添加active类 -->
        <div class="item">
          <?php don_the_thumbnail(); ?>
          <div class="carousel-caption">
            <h3><?php the_title(); ?></h3>
            <?php the_excerpt(); ?>
          </div>
        </div>
      <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>
        <!-- Reset Query  -->
        <?php wp_reset_query(); ?>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</div>
<?php get_footer(); ?>
