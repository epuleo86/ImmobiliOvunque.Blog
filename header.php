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
									<a class="nav-link" href="https://www.immobiliovunque.it/vendita-appartamenti">Vendita appartamenti</a>
								</li>

								<li class="nav-item">
									<a class="nav-link" href="https://www.immobiliovunque.it/affitto-appartamenti">Affitto appartamenti</a>
								</li>
								
								<li class="nav-item dropdown io-dropdown-menu">
									<a class="nav-link dropdown-toggle" href="https://www.immobiliovunque.it/agenzie">
										Agenzie
									</a>
									<div class="dropdown-menu dropdown-menu-dark mt-0">
										<a class="dropdown-item" href="https://www.immobiliovunque.it/formule-abbonamento">Formule abbonamento</a>
										<a class="dropdown-item" href="https://myio.immobiliovunque.it/" rel="nofollow" target="_blank">Area riservata</a>
									</div>
								</li>
																
								<li class="nav-item dropdown io-dropdown-menu">
									<a class="nav-link dropdown-toggle" href="#">
										Servizi immobiliari
									</a>
									<div class="dropdown-menu dropdown-menu-dark mt-0">
										<a class="dropdown-item" href="https://www.immobiliovunque.it/valutazione-immobiliare">Valuta casa</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/calcola-rata-mutuo">Calcola mutuo</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/agenti-immobiliari">Invia richiesta</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/permuta-casa">Permuta casa</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/segnalatore-immobiliare">Inizia a guadagnare</a>
										<a class="dropdown-item" href="https://www.immobiliovunque.it/vendocasa">Vendi casa</a>
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