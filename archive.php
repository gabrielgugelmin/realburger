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
    // if ( is_single() ) {
    //     $cats =  get_the_category();
    //     $cat = $cats[0];
    // } else {
    //     $cat = get_category( get_query_var( 'cat' ) );
    // }
    // $cat_slug = $cat->slug;    

   	// // Pegando informações da Categoria
    // $cat_Name = get_cat_name( $cat_ID );
    // $cat_ID = get_cat_ID( $cat_slug );

	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    
?>


<div class="PageContent--internal">
		<div class="container">
			<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
		</div> <!-- container -->

		<section class="Content Eventos u-pattern" >
				<div class="container">
					<h2 class="Content__title u-azure u-left"><?php echo $term->name; ?></h2>
				
					<div class="u-flex">

						<?php 

							$args = array(
								'orderby'       => 'date',
								'order'		    => 'ASC',
                                'posts_per_page' 	=> 9,	 
                                'paged' 	    => $paged, 
								'tax_query' => array(
									array(
										'taxonomy' => 'lojinha',
										'field'    => 'slug',
										'terms'    => $term->slug,
									),
								),
							);
							query_posts( $args);
                            if (have_posts()) :
							while ( have_posts() ) : the_post();

							$thumbnail = get_field('thumbnail');
							$post_date = get_the_date('j / F / Y');

							$image = get_the_post_thumbnail( get_the_ID(), 'full' );
							$preco = get_post_meta( get_the_ID(), 'preço', true );
							
							
						?>

						<article class="Item">
							
							<div class="Item__content">
								<div class="Item__title">
									<h3>
										<?php the_title(); ?>
									</h3>
								</div> <!-- Item__title -->

								<div class="Item__thumb"><?php echo $image; ?></div>

								<div class="Item__price"><?php echo $preco; ?></div>
								
							</div> <!-- Item-content -->
							<a href="<?php the_permalink(); ?>" class="u-button--blue">
								<span>QUERO!</span>
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
