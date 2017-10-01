<?php
/**
 *
 * @package WordPress
 * @subpackage APACN
 * @since APACN 1.0
 */
get_header(); ?>

<?php
    // Pegando Slug Categoria
    if ( is_single() ) {
        $cats =  get_the_category();
        $cat = $cats[0];
    } else {
        $cat = get_category( get_query_var( 'cat' ) );
    }
    $cat_slug = $cat->slug;    

   	// Pegando informações da Categoria
    $cat_Name = get_cat_name( $cat_ID );
    $cat_ID = get_cat_ID( $cat_slug );
    
?>


<div class="PageContent--internal">
		<div class="container">
			<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
		</div> <!-- container -->

		<section class="Content Eventos u-pattern" >
				<div class="container">
					<h2 class="Content__title u-azure u-left">EVENTOS & CAMPANHAS</h2>
				
					<div class="u-flex">

						<?php 

							$args = array(
								'cat'		    => '2, 3',
								'orderby'       => 'date',
								'order'		    => 'ASC',
                                'posts_per_page' 	=> 9,	 
                                'paged' 	    => $paged, 
							);
							query_posts( $args);
                            if (have_posts()) :
							while ( have_posts() ) : the_post();

							$thumbnail = get_field('thumbnail');
							$post_date = get_the_date('j / F / Y');

							$image = get_the_post_thumbnail( get_the_ID(), 'full' );

							$category = get_the_category();
							//print_r($category);
							$category_name = $category[0]->name;
							$category_id   = $category[0]->term_id;
							$category_link = get_category_link($category_id);

							//$category_name = get_the_category()[0]->name;
							//$category_id   = get_the_category()[0]->term_id;
							//$category_link = get_category_link($category_id);

							
						?>

						<article class="Item">
							<div class="Item__info">
								<?php
									if( $category_id == 2 ){ ?>
										<span class="Item__category--green">
											<a href="<?php echo $category_link; ?>"><?php echo $category_name; ?></a>
										</span> <!-- Item__category -->
									<?php 
									} else if( $category_id == 3 ){ ?>
										<span class="Item__category--orange">
											<a href="<?php echo $category_link; ?>"><?php echo $category_name; ?></a>
										</span> <!-- Item__category -->
									<?php 
									}
								?>
								
								<span class="Item__date">
									<?php echo $post_date; ?>
								</span> <!-- Item__date -->
							</div> <!-- Item__info -->

							<?php
								if( !empty($thumbnail) ){ ?>
									<div class="Item__img" style="background-image: url(<?php echo $thumbnail; ?>); "></div>
								<?php 
								}
							?>

							<div class="Item__content">
								<div class="Item__title">
									<h3>
										<?php the_title(); ?>
									</h3>
								</div> <!-- Item__title -->
								<p>
									<?php
										if( !empty($post_thumbnail_id) ){
											echo excerpt(120);
										} else{
											echo excerpt(400);
										}
									?>
								</p>
							</div> <!-- Item-content -->
							<a href="<?php the_permalink(); ?>" class="u-button--blue">
								<span>QUERO SABER MAIS!</span>
							</a>
						</article> <!-- Item -->						

						<?php 
							endwhile;
						    else: 
                            get_template_part( 'template-parts/content', 'no-results' );
                        endif; ?>
                    </div> <!-- row -->					
                </div> <!-- container -->
                <div class="container u-center">		
                    <?php if ( $wp_query->max_num_pages > 1 ) : ?>				    
                        <button class="load_more u-button--yellow">
                            <span><?php next_posts_link( 'CARREGAR MAIS' ); ?></span>
                        </button>
                    <?php endif;  ?>
                    <?php wp_reset_query(); ?>
                </div><!-- / .container -->
			</section> <!-- Content -->

	</div> <!-- PageContent -->


<?php get_footer(); ?>
