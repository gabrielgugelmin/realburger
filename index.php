<?php
/**
 *
 * @package WordPress
 * @subpackage APACN
 * @since APACN 1.0
 */
get_header(); ?>


<main class="PageContent">
			<section class="Banner--photo" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/banner.jpg);">
			
			</section> <!-- Banner -->
			<section class="Gallery">
				<div class="Container">
					<div class="Title">
						<h2 class="line">
							<span>GALERIA</span>
						</h2>
					</div> <!-- Title -->

					<div class="Gallery__wrapper">
						<div class="GallerySlider js-gallerySlider">
							<div class="GallerySlider__item" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/p1.jpg);"></div>
							<div class="GallerySlider__item" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/p2.jpg);"></div>
							<div class="GallerySlider__item" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/p1.jpg);"></div>
							<div class="GallerySlider__item" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/p2.jpg);"></div>
						</div>
		
						<div class="GalleryNav js-gallerySliderNav">
							<div class="GalleryNav__item" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/p1.jpg);"></div>
							<div class="GalleryNav__item" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/p2.jpg);"></div>
							<div class="GalleryNav__item" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/p1.jpg);"></div>
							<div class="GalleryNav__item" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/p2.jpg);"></div>
						</div>
					</div>
				</div> <!-- Content -->
			</section> <!-- Gallery -->

			<section class="Content Cardapio">
				<a href="#/" class="Button--big">
					<span>ver<br>cardápio</span>
				</a>
			</section>

			<section class="Stores">
				<div class="Container">
					<div class="Title">
						<h2 class="line">
							<span>NOSSAS LOJAS</span>
						</h2>
					</div> <!-- Title -->
				
					<article class="Content--left">
						<div class="Content__img" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/loja/loja1.jpg);"></div>

						<div class="Content__text">
							<h3>ALPHAVILLE</h3>

							<dl>
								<dt>ENDEREÇO</dt>
								<dd>Av. Sagitário, 138 - Alphaville Barueri<br>Shopping Alpha Square</dd>

								<dt>TELEFONE</dt>
								<dd>(11) 4193-8432</dd>

								<dt>HORÁRIO</dt>
								<dd>
									<dl>
										<dt>segunda a quinta</dt>
										<dd>11:30h às 15h — 18h às 22h</dd>

										<dt>sexta</dt>
										<dd>11:30h às 15h — 18h às 23h</dd>

										<dt>sábado</dt>
										<dd>12h às 23h</dd>

										<dt>domingo</dt>
										<dd>13h às 22h</dd>
									</dl>
								</dd>

								<dt>ESTACIONAMENTO</dt>
								<dd>R$ 10,00 = 2 horas. Lembrar de pedir o selo promocional.</dd>
							</dl>
						</div> <!-- Content__text -->
					</article> <!-- Store -->

					<article class="Content--right">
						<div class="Content__img" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/loja/loja2.jpg);"></div>

						<div class="Content__text">
							<h3>SHOPPING PÁTIO PAULISTA</h3>

							<dl>
								<dt>ENDEREÇO</dt>
								<dd>Rua Treze de Maio, 1947<br>Piso Paraíso - praça de alimentação</dd>

								<dt>TELEFONE</dt>
								<dd>(11) 3171-1949</dd>

								<dt>HORÁRIO</dt>
								<dd>
									<dl>
										<dt>segunda a domingo</dt>
										<dd>10h às 22h</dd>
									</dl>
								</dd>

								<dt>ESTACIONAMENTO</dt>
								<dd>Carro R$ 14 = 2 horas. Demais R$ 4.<br>
										Moto R$ 7 = 2 horas. Demais R$ 4.<br>
										Bicicleta é grátis.
								</dd>
							</dl>
						</div> <!-- Content__text -->
					</article> <!-- Store -->

					<article class="Content--left">
						<div class="Content__img" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/loja/loja3.jpg);"></div>

						<div class="Content__text">
							<h3>TATUAPÉ</h3>

							<dl>
								<dt>ENDEREÇO</dt>
								<dd>Rua Itapura, 1479<br>Tatuapé</dd>

								<dt>TELEFONE</dt>
								<dd>(11) 2092-4417</dd>

								<dt>HORÁRIO</dt>
								<dd>
									<dl>
										<dt>terça a quinta</dt>
										<dd>11:30h às 15h — 18h às 23h</dd>

										<dt>sexta</dt>
										<dd>11:30h às 15h — 18h às 00h</dd>

										<dt>sábado</dt>
										<dd>12h às 00h</dd>

										<dt>domingo</dt>
										<dd>12h às 00h</dd>
									</dl>
								</dd>
							</dl>
						</div> <!-- Content__text -->
					</article> <!-- Store -->

					<article class="Content--right">
						<div class="Content__img" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/loja/loja2.jpg);"></div>

						<div class="Content__text">
							<h3>SHOPPING PÁTIO PAULISTA</h3>

							<dl>
								<dt>ENDEREÇO</dt>
								<dd>Rua Treze de Maio, 1947<br>Piso Paraíso - praça de alimentação</dd>

								<dt>TELEFONE</dt>
								<dd>(11) 3171-1949</dd>

								<dt>HORÁRIO</dt>
								<dd>
									<dl>
										<dt>segunda a domingo</dt>
										<dd>10h às 22h</dd>
									</dl>
								</dd>

								<dt>ESTACIONAMENTO</dt>
								<dd>Carro R$ 14 = 2 horas. Demais R$ 4.<br>
										Moto R$ 7 = 2 horas. Demais R$ 4.<br>
										Bicicleta é grátis.
								</dd>
							</dl>
						</div> <!-- Content__text -->
					</article> <!-- Store -->

					<article class="Content--left">
						<div class="Content__img" style="background-image: url(<?php bloginfo('template_directory'); ?>/assets/img/loja/loja3.jpg);"></div>

						<div class="Content__text">
							<h3>TATUAPÉ</h3>

							<dl>
								<dt>ENDEREÇO</dt>
								<dd>Rua Itapura, 1479<br>Tatuapé</dd>

								<dt>TELEFONE</dt>
								<dd>(11) 2092-4417</dd>

								<dt>HORÁRIO</dt>
								<dd>
									<dl>
										<dt>terça a quinta</dt>
										<dd>11:30h às 15h — 18h às 23h</dd>

										<dt>sexta</dt>
										<dd>11:30h às 15h — 18h às 00h</dd>

										<dt>sábado</dt>
										<dd>12h às 00h</dd>

										<dt>domingo</dt>
										<dd>12h às 00h</dd>
									</dl>
								</dd>
							</dl>
						</div> <!-- Content__text -->
					</article> <!-- Store -->

				</div> <!-- Container -->
			</section> <!-- Stores -->

			<section class="Content Cardapio">
				<button class="Button--big js-modalContato">
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
							</div>
							<div class="Media__column">
								<img src="<?php bloginfo('template_directory'); ?>/assets/img/icons/instagram.svg" alt="Instagram">
							</div>
						</div> <!-- Media__content -->
					</div> <!-- Title -->
				</div>
			</section> <!-- Media -->
		</main> <!-- PageContent -->
<?php get_footer(); ?>