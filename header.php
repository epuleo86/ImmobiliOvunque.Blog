<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body class="io-dark-nav">
	<div id="page" class="site">
		<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
			<header id="masthead" class="site-header navbar-static-top bg-black" role="banner">
				<div class="container px-0">
					<nav class="navbar navbar-expand-lg navbar-dark py-2">
						<a class="navbar-brand" href="https://www.immobiliovunque.it/"><image src="https://static.immobiliovunque.it/resources/img/logo-esteso.svg" class="nav-logo" alt="Logo Immobili Ovunque" width="120" height="60" /></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto mx-auto">
								<li class="nav-item">
									<a class="nav-link" href="https://www.immobiliovunque.it/">Home</a>
								</li>
								
								<li class="nav-item <?php echo (is_front_page() ? 'active' : '') ?>">
									<a class="nav-link" href="https://www.immobiliovunque.it/blog/">Blog</a>
								</li>
								
								<li class="nav-item dropdown <?php echo (is_category() ? 'active' : '') ?>">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Categorie
									</a>
									<div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
										<a class="dropdown-item <?php echo (is_category(2766) ? 'active' : '') ?>" href="https://www.immobiliovunque.it/blog/affitti-e-locazioni/">Affitti e Locazioni</a>
										<a class="dropdown-item <?php echo (is_category(2767) ? 'active' : '') ?>" href="https://www.immobiliovunque.it/blog/arredamento-casa/">Arredamento casa</a>
										<a class="dropdown-item <?php echo (is_category(2801) ? 'active' : '') ?>" href="https://www.immobiliovunque.it/blog/bonus-e-incentivi/">Bonus e Incentivi</a>
										<a class="dropdown-item <?php echo (is_category(2799) ? 'active' : '') ?>" href="https://www.immobiliovunque.it/blog/case-a-1-euro/">Case ad 1 Euro</a>
										<a class="dropdown-item <?php echo (is_category(2727) ? 'active' : '') ?>" href="https://www.immobiliovunque.it/blog/compravendita-immobiliare/">Compravendita immobiliare</a>
										<a class="dropdown-item <?php echo (is_category(2800) ? 'active' : '') ?>" href="https://www.immobiliovunque.it/blog/comuni-di-italia/">Comuni d'Italia</a>
										<a class="dropdown-item <?php echo (is_category(19) ? 'active' : '') ?>" href="https://www.immobiliovunque.it/blog/edilizia-e-costruzioni/">Edilizia e Costruzioni</a>
										<a class="dropdown-item <?php echo (is_category(13) ? 'active' : '') ?>" href="https://www.immobiliovunque.it/blog/fisco-imposte-e-tasse/">Fisco, Imposte e Tasse</a>
										<a class="dropdown-item <?php echo (is_category(10) ? 'active' : '') ?>" href="https://www.immobiliovunque.it/blog/mercato-immobiliare/">Mercato immobiliare</a>
										<a class="dropdown-item <?php echo (is_category(2798) ? 'active' : '') ?>" href="https://www.immobiliovunque.it/blog/mutui-e-finanziamenti/">Mutui e Finanzamenti</a>
										<a class="dropdown-item <?php echo (is_category(18) ? 'active' : '') ?>" href="https://www.immobiliovunque.it/blog/news-immobili-ovunque/">News</a>
										
									</div>
								</li>
								
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Case in vendita
									</a>
									<div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="https://www.immobiliovunque.it/vendita-appartamenti/roma" title="Case in vendita Roma">Roma</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/vendita-appartamenti/milano" title="Case in vendita Milano">Milano</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/vendita-appartamenti/firenze" title="Case in vendita Firenze">Firenze</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/vendita-appartamenti/genova" title="Case in vendita Genova">Genova</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/vendita-appartamenti/bologna" title="Case in vendita Bologna">Bologna</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/vendita-appartamenti/torino" title="Case in vendita Torino">Torino</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/vendita-appartamenti/napoli" title="Case in vendita Napoli">Napoli</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/vendita-appartamenti/bari" title="Case in vendita Bari">Bari</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/vendita-appartamenti/palermo" title="Case in vendita Palermo">Palermo</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/vendita-appartamenti" title="Vendita appartamenti">Altre città</a>
									</div>
								</li>

								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Case in affitto
									</a>
									<div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="https://www.immobiliovunque.it/affitto-appartamenti/roma" title="Case in affitto Roma">Roma</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/affitto-appartamenti/milano" title="Case in affitto Milano">Milano</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/affitto-appartamenti/torino" title="Case in affitto Torino">Torino</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/affitto-appartamenti/napoli" title="Case in affitto Napoli">Napoli</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/affitto-appartamenti/palermo" title="Case in affitto Palermo">Palermo</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/affitto-appartamenti/firenze" title="Case in affitto Firenze">Firenze</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/affitto-appartamenti/bologna" title="Case in affitto Bologna">Bologna</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/affitto-appartamenti/genova" title="Case in affitto Genova">Genova</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/affitto-appartamenti/bari" title="Case in affitto Bari">Bari</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/affitto-appartamenti" title="Affitto appartamenti">Altre città</a>
									</div>
								</li>

								<li class="nav-item">
									<a class="nav-link" href="https://www.immobiliovunque.it/agenti-immobiliari">Invia richiesta</a>
								</li>

								<li class="nav-item">
									<a class="nav-link" href="https://www.immobiliovunque.it/calcola-rata-mutuo">Calcola mutuo</a>
								</li>
								
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Servizi
									</a>
									<div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="https://www.immobiliovunque.it/permuta-casa">Permuta casa</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/valutazione-immobiliare">Valutazione immobiliare</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/vendocasa">Vendi casa</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/segnalatore-immobiliare">Inizia a guadagnare</a>
									</div>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</header><!-- #masthead -->
			<div id="content" class="site-content">
				<div class="container container-bordered">
					<div class="row header-spacer-row pb-3 px-3">
	<?php endif; ?>