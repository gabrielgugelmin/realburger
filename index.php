<?php
/**
 *
 * @package WordPress
 * @subpackage APACN
 * @since APACN 1.0
 */
get_header(); ?>


<main class="PageContent">

	<?php 
		$video_webm	= get_field('video_webm', 29); // home
		$video_mp4	= get_field('video_mp4', 29); // home
		$banner_img		= the_post_thumbnail_url();

		if( $video_webm && $video_mp4 ){ ?>
			<section class="Banner">
				<video poster="<?php echo $banner_img; ?>" id="bgvid" playsinline autoplay muted loop>
					<source src="<?php echo $video_webm; ?>" type="video/webm">
					<source src="<?php echo $video_mp4; ?>" type="video/mp4">
				</video>
			</section>
		<?php 
		} else{ ?>
			<section class="Banner--photo" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/banner.jpg);"></section>
		<?php 
		}
	?>

		<section class="Gallery" id="galeria">
			<div class="Container">
				<div class="Title">
					<h2 class="line">
						<span>GALERIA</span>
					</h2>
				</div> <!-- Title -->

				<div class="Gallery__wrapper">
					
					<?php
						//$fields = get_fields(29);
						$id_home = 29; //get_page_by_path( 'home' ); ?>


							<div class="GallerySlider js-gallerySlider">
							<?php

							$imagens = array();

							for( $i = 1; $i <= 8; $i++ ){
								$img = get_field('galeria_imagem_' . $i, 29 );

								if( $img != "" ) $imagens[] = $img;

							}

							foreach( $imagens as $imagem){
								if( $imagem != "" ){ ?>
									<div class="GallerySlider__item" style="background-image: url(<?php echo $imagem; ?>);"></div>	
								<?php 
								}
								?>
							<?php
							} ?>
							</div> <!-- GallerySlider -->		
	
							<div class="GalleryNav js-gallerySliderNav">
							<?php
							foreach( $imagens as $imagem){
								if( $imagem != "" ){ ?>
									<div class="GalleryNav__item" style="background-image: url(<?php echo $imagem; ?>);"></div>	
								<?php 
								}
								?>
							<?php
							} ?>
							</div> <!-- GalleryNav -->
						</div>
				</div> <!-- Gallery__wrapper -->
			</div> <!-- Container -->
		</section> <!-- Gallery -->

		<section class="Content Cardapio">
			<a href="#/" class="Button--big">
				<span>ver<br>cardápio</span>
			</a>
		</section>

		<section class="Stores" id="lojas">
			<div class="Container">
				<div class="Title">
					<h2 class="line">
						<span>NOSSAS LOJAS</span>
					</h2>
				</div> <!-- Title -->

				<?php 
					$args = array(			  
						'post_type'   => 'lojas',
						'orderby'     => 'menu_order',
						'order'				=> 'ASC'
					);
					query_posts( $args);
					$c = 0;
					$classeLoja;

					while ( have_posts() ) : the_post();

					$imagem = get_field( 'imagem' );
					$nome_loja = get_field( 'nome_loja' );
					$endereco = get_field( 'endereco' );
					$telefone = get_field( 'telefone' );
					$horario = get_field( 'horario' );
					$estacionamento = get_field( 'estacionamento' );

					if($c % 2 == 0){
						$classeLoja = 'Content--left';
					} else {
						$classeLoja = 'Content--right';
					}
				?>
				
			
				<article class="<?php echo $classeLoja; ?>">
					<div class="Content__img" style="background-image: url(<?php echo $imagem; ?>)"></div>

					<div class="Content__text">
						<h3><?php echo $nome_loja; ?></h3>

						<dl>
							<?php
								if($endereco){ ?>
									<dt>ENDEREÇO</dt>
									<dd><?php echo $endereco; ?></dd>
								<?php
								}
							?>

							<?php
								if($telefone){ ?>
									<dt>TELEFONE</dt>
									<dd><?php echo $telefone; ?></dd>
								<?php
								}
							?>

							<?php
								if($horario){ ?>
									<dt>HORÁRIO</dt>
									<dd>
										<?php echo $horario; ?>
									</dd>
								<?php
								}
							?>

							<?php
								if($estacionamento){ ?>
									<dt>ESTACIONAMENTO</dt>
									<dd><?php echo $estacionamento; ?></dd>
								<?php
								}
							?>
						</dl>
					</div> <!-- Content__text -->
				</article> <!-- Store -->


				<?php 
					$c++;
					endwhile;
					wp_reset_query();
				?>

			</div> <!-- Container -->
		</section> <!-- Stores -->

		<section class="Content Cardapio">
			<button class="Button--big js-contato">
				<span>fale<br>conosco</span>
			</button>
		</section>

		<section class="Media">
			<div class="Container">
				<div class="Title">
					<h2 class="line"><span>REDES SOCIAIS</span></h2>

					<div class="Media__content">
						<div class="Media__column">
							<img src="<?php bloginfo('template_directory'); ?>/assets/img/icons/facebook.svg" alt="Facebook">

							<div class="Media__box">
								<div class="fb-page" data-href="https://www.facebook.com/realburgeroficial/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/realburgeroficial/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/realburgeroficial/">Real Burger</a></blockquote></div>
							</div>
						</div>
						<div class="Media__column">
							<img src="<?php bloginfo('template_directory'); ?>/assets/img/icons/instagram.svg" alt="Instagram">

							<div class="Media__box">
								<section id="instafeed" class="Instafeed"></section>
							</div>
						</div>
					</div> <!-- Media__content -->
				</div> <!-- Title -->
			</div>
		</section> <!-- Media -->
	</main> <!-- PageContent -->
<?php get_footer(); ?>