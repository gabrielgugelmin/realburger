<?php
/**
 *
 * @package WordPress
 * @subpackage Realburger
 * @since Realburger 1.0
 */

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<main class="PageContent <?php if(!$is_home) { echo 'internal'; } ?>">
  <!-- <section class="Banner--photo" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></section> -->

  <div class="Container">
    <div class="Content--internal">
      <article class="Content--left">
        <div class="Content__img" style="background-image: url(<?php echo get_field('primeira_imagem'); ?>);"></div>

        <div class="Content__text">
          <h2 class="line">
            <span><?php echo get_field('primeiro_titulo'); ?></span>
          </h2>

          <p>
            <?php echo get_field('primeiro_texto'); ?>
          </p>
          
        </div> <!-- Content__text -->
      </article> <!-- Store -->

      <article class="Content--right">
        <div class="Content__img">
          <div class="Content__slider js-sliderContent">
            <?php 
              if( get_field('imagem_carrossel_1') ){ ?>
                <div class="Content__sliderItem" style="background-image: url(<?php echo get_field('imagem_carrossel_1'); ?>);"></div>
              <?php 
              }
              if( get_field('imagem_carrossel_2') ){ ?>
                <div class="Content__sliderItem" style="background-image: url(<?php echo get_field('imagem_carrossel_2'); ?>);"></div>
              <?php 
              }
              if( get_field('imagem_carrossel_3') ){ ?>
                <div class="Content__sliderItem" style="background-image: url(<?php echo get_field('imagem_carrossel_3'); ?>);"></div>
              <?php 
              }
              if( get_field('imagem_carrossel_4') ){ ?>
                <div class="Content__sliderItem" style="background-image: url(<?php echo get_field('imagem_carrossel_4'); ?>);"></div>
              <?php 
              }
            
            ?>
          </div>
        </div>

        <div class="Content__text">
          <h2 class="line">
            <span><?php echo get_field('segundo_titulo'); ?></span>
          </h2>

          <p>
            <?php echo get_field('segundo_texto'); ?>
          </p>
        </div> <!-- Content__text -->
      </article> <!-- Store -->
    </div> <!-- Content--internal -->

    <div class="Excerpt">
      <p>
        <?php echo get_field('fechamento', 8); ?>
      </p>

      <h6>
      <?php echo get_field('titulo_final', 8); ?>
      </h6>
    </div>
  </div> <!-- Container -->
</main> <!-- PageContent -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>
