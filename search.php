<?php
/**
 *
 * @package WordPress
 * @subpackage APACN
 * @since APACN 1.0
 */
get_header(); ?>


<div class="PageContent--internal">
		<div class="container">
			<?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
		</div> <!-- container -->

		<section class="Title--background" style="background-image:url(<?php bloginfo('template_directory'); ?>/assets/img/header-noticias.jpg);">
			<div class="container">
				<h1>Resultados para: <?php echo $_GET['s']; ?></h1>
			</div>
		</section> <!-- Title -->

		<section class="News">
			<div class="container" id="Posts">
				<div class="row">

				<?php 
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 

					$args = array(			  
						's'   => anti_injection($_GET['s']),
						'posts_per_page' 	=> 10,	  
						'post_type'   		=> 'post',
						'orderby'     		=> 'date',
						'paged' 			=> $paged,
					);
					query_posts( $args);
					$i = 0;

					while ( have_posts() ) : the_post();

					$i++;
					$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
					$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

					//$image = get_the_post_thumbnail( get_the_ID(), 'full' ); 
					$endereco = get_post_meta(get_the_ID(), 'endereço', true);						
									
				?>	

					<?php 
						if( empty($post_thumbnail_url) ){ ?>
							<article class="Item--news--center">
								<div class="Item__content">
									<div class="Item__title">
										<h3>
											<a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
										</h3>
									</div> <!-- Item__title -->
									<p>
										<?php echo excerpt(780); ?>
									</p>
						<?php 
						} else{ ?>
							<article class="Item--news">
								<div class="Item__img" style="background-image: url(<?php echo $post_thumbnail_url; ?>); "></div>
								<div class="Item__content">
									<div class="Item__title">
										<h3>
											<a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
										</h3>
									</div> <!-- Item__title -->
									<p>
										<?php echo excerpt(120); ?>
									</p>
						<?php 
						}
					?>					
							<footer>
								<ul class="Social">
									<li>
										<a href="#/">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="16px" viewBox="7 4 9 16" enable-background="new 7 4 9 16" xml:space="preserve">
												<g>
													<path fill="#FFF" d="M13,10h3v3h-3v7h-3v-7H7v-3h3V8.745c0-1.189,0.374-2.691,1.118-3.512C11.862,4.41,12.791,4,13.904,4H16v3h-2.1
														C13.402,7,13,7.402,13,7.899V10z"/>
												</g>
											</svg>
										</a>
									</li>
									<li>
										<a href="#/">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="11.199px" height="8px" viewBox="0 0 11.199 8" enable-background="new 0 0 11.199 8" xml:space="preserve">
												<g>
													<path fill="#FFF" d="M5.602,5.602L4.215,4.387L0.254,7.781C0.398,7.918,0.59,8,0.805,8h9.589c0.215,0,0.406-0.082,0.551-0.219
														L6.984,4.387L5.602,5.602z M5.602,5.602"/>
													<path fill="#FFF" d="M10.945,0.219C10.805,0.082,10.609,0,10.395,0H0.805C0.594,0,0.398,0.082,0.254,0.219l5.348,4.582
														L10.945,0.219z M10.945,0.219"/>
													<path fill="#FFF" d="M0,0.703v6.645l3.867-3.286L0,0.703z M0,0.703"/>
													<path fill="#FFF" d="M7.332,4.062l3.867,3.286V0.699L7.332,4.062z M7.332,4.062"/>
												</g>
											</svg>
										</a>
									</li>
									<li>
										<a href="#/">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="380.945px" height="309.697px" viewBox="115.587 332.537 380.945 309.697" enable-background="new 115.587 332.537 380.945 309.697" xml:space="preserve">
												<path id="XMLID_22_" fill="#FFF" d="M235.357,642.234c143.796,0,222.448-119.173,222.448-222.447c0-3.348,0-6.694-0.239-10.16
													c15.3-11.117,28.448-24.743,38.967-40.521c-14.224,6.335-29.404,10.519-44.943,12.312c16.376-9.801,28.567-25.102,34.425-43.27
													c-15.3,9.084-32.154,15.539-49.605,19.005c-29.644-31.437-79.13-32.991-110.566-3.347c-20.32,19.125-28.927,47.573-22.592,74.707
													c-62.873-3.108-121.443-32.871-161.128-81.64c-20.798,35.74-10.16,81.401,24.146,104.351c-12.431-0.358-24.623-3.706-35.501-9.802
													c0,0.358,0,0.598,0,0.956c0,37.175,26.297,69.209,62.754,76.62c-11.475,3.107-23.547,3.586-35.262,1.314
													c10.28,31.795,39.565,53.67,73.034,54.268c-27.731,21.754-61.917,33.588-97.06,33.588c-6.216,0-12.432-0.358-18.646-1.076
													C151.207,630.042,192.804,642.234,235.357,642.234"/>
											</svg>
										</a>
									</li>
								</ul>
								<a href="<?php echo the_permalink(); ?>" class="Item__link">
									continuar lendo
								</a>
							</footer>
						</div> <!-- Item-content -->
					</article> <!-- Item--news -->

					<?php 
						if($i % 2 == 0){
							echo '</div><div class="row">';
						}

						endwhile;							
					?>						
				</div> <!-- row -->					
			</div> <!-- container -->
			<div class="container">		
				<?php if ( $wp_query->max_num_pages > 1 ) : ?>				    
					<!--<button class="load_more u-button--yellow">
						<span><?php next_posts_link( 'CARREGAR MAIS' ); ?></span>
					</button>-->
				<?php endif;  ?>
				<?php wp_reset_query(); ?>
			</div><!-- / .container -->
		</section> <!-- News -->

	</div> <!-- PageContent -->

<?php get_footer(); ?>