<?php
/**
 *
 * @package WordPress
 * @subpackage Realburger
 */
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Real Burger - Hambúrger de verdade</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">

	<!-- FACEBOOK -->
	<meta property="og:url"                content="" />
	<meta property="og:type"               content="" />
	<meta property="og:title"              content="" />
	<meta property="og:description"        content="" />
	<meta property="og:image"              content="" />

	<?php wp_head(); ?>
</head>
<body>

<?php
	$is_home = is_home();
?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NF5NP3V');</script>
<!-- End Google Tag Manager -->
 
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NF5NP3V"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-100284713-1"></script>
<script>
 window.dataLayer = window.dataLayer || [];
 function gtag(){dataLayer.push(arguments)};
 gtag('js', new Date());
 
 gtag('config', 'UA-100284713-1');
</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=178694185943977";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="Popup" data-modal="contato">
	<div class="Popup__container">
		<h3>FALE<br>CONOSCO</h3>
		<button class="Popup__close">
			<img src="<?php bloginfo('template_directory'); ?>/assets/img/icons/close.svg" alt="Fechar">
		</button>
		
		<form action="" class="Form">
			<div class="Form__control" data-validate="true">
				<label for="nome">NOME <span>*</span></label>
				<input type="text" name="nome">
			</div> <!-- Form__control -->

			<div class="Form__control" data-validate="true">
				<label for="email">EMAIL <span>*</span></label>
				<input type="email" name="email">
			</div> <!-- Form__control -->

			<div class="Form__control" data-validate="true">
				<label for="assunto">ASSUNTO <span>*</span></label>
				<input type="text" name="assunto">
			</div> <!-- Form__control -->

			<div class="Form__control">
				<div class="Dropdown">
					<label for="set-loja">LOJA</label>
					<span class="set-loja">SELECIONE</span>
					<input class="set-loja" type="hidden" name="loja">

					<?php 
						$args = array(			  
							'post_type'   => 'lojas',
							'orderby'     => 'title',
							'order'				=> 'ASC'
						);
						query_posts( $args);

						if ( have_posts() ) { ?>
						<ul class="js-scrollbar">
							<?php
							while ( have_posts() ) : the_post();
								$nome_loja = get_field( 'nome_loja' ); 
								$nome_sub = get_field( 'nome_loja_seg' ); ?>
								
								<li><a href="#" data-set="set-loja" data-option="<?php echo to_permalink($nome_loja); ?>"><?php echo $nome_loja . ' ' . $nome_sub; ?></a></li>

							<?php 
							endwhile; 
							?>
							</ul>
						<?php 
						}
							wp_reset_query();
						?>
				</div> <!-- Dropdown -->
			</div> <!-- Form__control -->

			<div class="Form__control" data-validate="true">
				<label for="mensagem">MENSAGEM <span>*</span></label>
				<textarea name="mensagem" id="mensagem" cols="30" rows="2"></textarea>
			</div> <!-- Form__control -->

			<input type="submit" class="Button" value="ENVIAR">
		</form>

	</div> <!-- Popup-container -->
</div> <!-- Popup -->

<div class="Popup" data-modal="lojas">
	<div class="Popup__container">
		<h3>ESCOLHA A LOJA<br>MAIS PRÓXIMA</h3>
		<button class="Popup__close">
			<img src="<?php bloginfo('template_directory'); ?>/assets/img/icons/close.svg" alt="Fechar">
		</button>
		
		<?php 
				$args = array(			  
					'post_type'   => 'lojas',
					'orderby'     => 'menu_order',
					'order'				=> 'ASC'
				);
				query_posts( $args);

				if ( have_posts() ) { ?>
				<ul class="Popup__list">
					<?php
					while ( have_posts() ) : the_post();
						$nome_loja 			= get_field( 'nome_loja' ); 
						$link_cardapio 	= get_field( 'link_cardapio' );

						if( $link_cardapio ){ ?>
							<li><a href="<?php echo $link_cardapio; ?>" target="_blank"><?php echo $nome_loja; ?></a></li>
						<?php 
						}
					endwhile; 
					?>
					</ul>
				<?php 
				}
					wp_reset_query();
				?>
						

	</div> <!-- Popup-container -->
</div> <!-- Popup -->

<div class="Popup">
	<div class="Popup__container">
		<h3><?php echo $mensagem_titulo; ?></h3>
		<p><?php echo $mensagem_corpo; ?></p>

		<button class="Popup__close">fechar</button>
	</div> <!-- Popup-container -->
</div> <!-- Popup -->

	<div class="PageWrapper">
		<div class="Container">
			<div class="Share">
				<ul class="Social">
					<li>
					<a href="https://www.facebook.com/realburgeroficial/" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="8896 6260 20 40"><defs><style>.cls-1 {fill: #fff;}</style></defs><path id="if_icon-social-facebook_211902" class="cls-1" d="M173.333,77.333V73.365c0-1.792.4-2.7,3.177-2.7H180V64h-5.823c-7.135,0-9.49,3.271-9.49,8.885v4.448H160V84h4.688v20h8.646V84h5.875L180,77.333Z" transform="translate(8736 6196)"/></svg>
						</a>
					</li>
					<li>
					<a href="https://www.instagram.com/realburgeroficial/" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="8966 6263 35.008 35"><defs><style>.cls-1 {fill: #fff;}</style></defs><g id="if_Glyph_1164452" transform="translate(8961.9 6258.9)"><path id="Path_20" data-name="Path 20" class="cls-1" d="M21.6,7.253c4.675,0,5.223.021,7.071.1a9.549,9.549,0,0,1,3.251.6,5.43,5.43,0,0,1,2.014,1.306,5.346,5.346,0,0,1,1.306,2.014,9.728,9.728,0,0,1,.6,3.251c.083,1.848.1,2.4.1,7.071s-.021,5.223-.1,7.071a9.549,9.549,0,0,1-.6,3.251,5.43,5.43,0,0,1-1.306,2.014,5.346,5.346,0,0,1-2.014,1.306,9.728,9.728,0,0,1-3.251.6c-1.848.083-2.4.1-7.071.1s-5.223-.021-7.071-.1a9.549,9.549,0,0,1-3.251-.6,5.43,5.43,0,0,1-2.014-1.306,5.346,5.346,0,0,1-1.306-2.014,9.728,9.728,0,0,1-.6-3.251c-.083-1.848-.1-2.4-.1-7.071s.021-5.223.1-7.071a9.549,9.549,0,0,1,.6-3.251A5.43,5.43,0,0,1,9.261,9.268a5.346,5.346,0,0,1,2.014-1.306,9.728,9.728,0,0,1,3.251-.6c1.848-.09,2.4-.1,7.071-.1m0-3.153c-4.751,0-5.348.021-7.217.1a12.825,12.825,0,0,0-4.244.813,8.528,8.528,0,0,0-3.1,2.021,8.679,8.679,0,0,0-2.021,3.1A12.833,12.833,0,0,0,4.2,14.387c-.083,1.861-.1,2.459-.1,7.21s.021,5.348.1,7.217a12.909,12.909,0,0,0,.813,4.251,8.528,8.528,0,0,0,2.021,3.1,8.679,8.679,0,0,0,3.1,2.021A12.833,12.833,0,0,0,14.387,39c1.868.083,2.459.1,7.217.1s5.348-.021,7.217-.1a12.909,12.909,0,0,0,4.251-.813,8.528,8.528,0,0,0,3.1-2.021,8.679,8.679,0,0,0,2.021-3.1A12.833,12.833,0,0,0,39,28.813c.083-1.868.1-2.459.1-7.217s-.021-5.348-.1-7.217a12.909,12.909,0,0,0-.813-4.251,8.528,8.528,0,0,0-2.021-3.1,8.679,8.679,0,0,0-3.1-2.021A12.833,12.833,0,0,0,28.82,4.2c-1.875-.076-2.473-.1-7.224-.1Z" transform="translate(0 0)"/><path id="Path_21" data-name="Path 21" class="cls-1" d="M135.588,126.6a8.988,8.988,0,1,0,8.988,8.988A8.989,8.989,0,0,0,135.588,126.6Zm0,14.822a5.834,5.834,0,1,1,5.834-5.834A5.834,5.834,0,0,1,135.588,141.422Z" transform="translate(-113.991 -113.991)"/><ellipse id="Ellipse_3" data-name="Ellipse 3" class="cls-1" cx="2.098" cy="2.098" rx="2.098" ry="2.098" transform="translate(28.841 10.157)"/></g></svg>
						</a>
					</li>
				</ul> <!-- Social -->
			</div>
		</div>

		<nav class="Bar <?php if(!$is_home) { echo 'is-visible'; } ?>">
			<div class="Container">
				<a href="<?php echo get_home_url(); ?>">
					<img src="<?php bloginfo('template_directory'); ?>/assets/img/logo-small.png" alt="Real Burger" class="Bar__logo">
				</a>

				<nav class="Menu">
					<?php wp_nav_menu(array( 'menu_class' => null, 'container' => null )); ?>
				</nav>

				<!-- <nav class="Menu">
					<ul>
						<li><a href="sobre.html">SOBRE</a></li>
						<li class="Menu--hasSub">
							<a href="#">CARDÁPIO</a>

							<ul class="Menu-sub">
								<li>CARDÁPIO</li>
								<li class="js-back"><a href="#/">VOLTAR</a></li>

								<li><a href="#/" target="_blank">ALPHAVILLE</a></li>
								<li><a href="#/" target="_blank">SHOPPING PAULISTA</a></li>
								<li><a href="#/" target="_blank">TATUAPÉ</a></li>
							</ul>
						</li>
						<li><a href="#/">GALERIA</a></li>
						<li class="Menu--hasSub">
							<a href="#">PEDIDO ONLINE</a>

							<ul class="Menu-sub">
								<li>PEDIDO ONLINE</li>
								<li class="js-back"><a href="#/">VOLTAR</a></li>

								<li><a href="#/" target="_blank">ALPHAVILLE</a></li>
								<li><a href="#/" target="_blank">SHOPPING PAULISTA</a></li>
								<li><a href="#/" target="_blank">TATUAPÉ</a></li>
							</ul>
						</li>
						<li><a href="#/">NOSSAS LOJAS</a></li>
						<li><a href="#/">CONTATO</a></li>
					</ul>
				</nav> -->

				<a href="#/" class="MenuTrigger">
					<span></span>
				</a>
			</div> <!-- Container -->
		</nav> <!-- Bar -->

		<?php 
			if($is_home){ ?>
				<header class="Header" id="Header">
					<img src="<?php bloginfo('template_directory'); ?>/assets/img/logo.png" alt="Real Burger" class="Header__logo">
		
					<nav class="Menu">
						<?php wp_nav_menu(array( 'menu_class' => null, 'container' => null )); ?>
					</nav>				
		
					<a class="Header__call Button js-lojas" href="#/">
						<span>PEÇA AGORA</span>
					</a>
		
					<a href="#galeria" class="js-scroll"></a>
				</header>
			<?php 
				}
		
		?>