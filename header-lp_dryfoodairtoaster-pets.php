<?php
global $dp_options, $post, $usces;
if (! $dp_options) $dp_options = get_design_plus_options();

$show_header_upper = false;
$header_desc = null;
$header_desc_mobile = null;

if ('type1' === $dp_options['header_site_desc_type'] || (is_front_page() && 'type2' === $dp_options['header_site_desc_type'])) :
	$header_desc = trim(get_bloginfo('description'));
	if ($dp_options['use_site_desc_mobile']) :
		$header_desc_mobile = trim($dp_options['site_desc_mobile']);
	endif;
endif;

if ($header_desc_mobile && ! $header_desc && ! $dp_options['show_header_search']) :
	$show_header_upper = 'mobile';
elseif ($header_desc || $dp_options['show_header_search']) :
	$show_header_upper = true;
endif;

$totalquantity = null;
if (is_welcart_active()) :
	$totalquantity = $usces->get_total_quantity();
elseif (is_woocommerce_active()) :
	$totalquantity = WC()->cart->get_cart_contents_count();
endif;
if (! $totalquantity) :
	$totalquantity = null;
endif;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head <?php if ($dp_options['use_ogp']) {
			echo 'prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"';
		} ?>>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="description" content="HOMAREのドライフードエアートースターはペットにも大切な酵素が含まれたペットフードが作れます！">
	<meta name="viewport" content="width=device-width">
	<?php if ($dp_options['use_ogp']) {
		ogp();
	} ?>
	<!-- css -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap"
		rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dryfoodairtoaster-pets_lp/css/style.css" />
	<!-- JavaScript -->
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script defer src="<?php echo get_template_directory_uri(); ?>/dryfoodairtoaster-pets_lp/js/script.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	do_action('tcd_before_header', $dp_options);

	// LPページでヘッダー表示しない場合ここでreturn
	if (is_page_template('page-homare_dryfoodairtoaster-pets.php') && 'show' !== $post->lp_show_header) :
		return;
	endif;
	?>
	<header id="js-header" class="l-header">
		<div class="l-header__bar l-header__bar--mobile">
			<?php
			if ($show_header_upper) :
			?>
				<div class="p-header__upper<?php if ('mobile' === $show_header_upper) echo ' u-visible-sm'; ?>">
					<div class="p-header__upper-inner l-inner">
						<?php
						if ($header_desc && null !== $header_desc_mobile) :
						?>
							<div class="p-header-description u-hidden-sm"><?php echo esc_html($header_desc); ?></div>
							<div class="p-header-description u-visible-sm"><?php echo str_replace(array("\r\n", "\r", "\n"), '<br>', esc_html($header_desc_mobile)); ?></div>
						<?php
						elseif ($header_desc) :
						?>
							<div class="p-header-description"><?php echo esc_html($header_desc); ?></div>
						<?php
						elseif ($header_desc_mobile) :
						?>
							<div class="p-header-description u-visible-sm"><?php echo str_replace(array("\r\n", "\r", "\n"), '<br>', esc_html($header_desc_mobile)); ?></div>
						<?php
						endif;

						if ($dp_options['show_header_search']) :
						?>
							<div class="p-header__upper-search">
								<div class="p-header__upper-search__form">
									<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
										<input class="p-header__upper-search__input" name="s" type="text" value="<?php echo esc_attr(get_query_var('s')); ?>">
										<button class="p-header__upper-search__submit c-icon-button">&#xe915;</button>
									</form>
								</div>
								<button id="js-header__search" class="p-header__upper-search__button c-icon-button"></button>
							</div>
						<?php
						endif;
						?>
					</div>
				</div>
			<?php
			endif;
			?>
			<div class="p-header__lower">
				<div class="p-header__lower-inner l-inner">
					<?php
					$logotag = is_front_page() ? 'h1' : 'div';
					if ('yes' == $dp_options['use_header_logo_image'] && $image = wp_get_attachment_image_src($dp_options['header_logo_image'], 'full')) :
					?>
						<<?php echo $logotag; ?> class="p-logo p-header__logo<?php if ($dp_options['header_logo_image_retina']) {
																					echo ' p-header__logo--retina';
																				} ?>">
							<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_attr($image[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" <?php if ($dp_options['header_logo_image_retina']) echo ' width="' . floor($image[1] / 2) . '"'; ?>></a>
						</<?php echo $logotag; ?>>
					<?php
					else :
					?>
						<<?php echo $logotag; ?> class="p-logo p-header__logo p-header__logo--text">
							<a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
						</<?php echo $logotag; ?>>
					<?php
					endif;

					if ('yes' == $dp_options['use_header_logo_image_mobile'] && $image = wp_get_attachment_image_src($dp_options['header_logo_image_mobile'], 'full')) :
					?>
						<div class="p-logo p-header__logo--mobile<?php if ($dp_options['header_logo_image_mobile_retina']) echo ' p-header__logo--retina'; ?>">
							<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_attr($image[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" <?php if ($dp_options['header_logo_image_mobile_retina']) echo ' width="' . floor($image[1] / 2) . '"'; ?>></a>
						</div>
					<?php
					else :
					?>
						<div class="p-logo p-header__logo--mobile p-header__logo--text">
							<a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
						</div>
					<?php
					endif;
					?>
					<div id="js-drawer" class="p-drawer">
						<div class="p-drawer__contents">
							<?php
							if (is_welcart_active()) :
							?>
								<ul class="p-drawer__membermenu p-drawer__membermenu02 p-drawer__menu">
									<?php
									if (usces_is_membersystem_state()) :
										if (usces_is_login()) :
									?>
											<li class="p-header__membermenu-mypage"><a href="<?php echo esc_attr(USCES_MEMBER_URL); ?>"><?php echo esc_html(get_welcart_member_page_original_title()); ?></a></li>
										<?php
										else :
										?>
											<li class="p-header__membermenu-login"><a href="<?php echo esc_attr(USCES_LOGIN_URL); ?>"><?php _e('Login', 'tcd-w'); ?></a></li>
									<?php
										endif;
									endif;
									?>
									<li class="p-header__membermenu-wishlist"><a href="<?php echo esc_attr(add_query_arg('page', 'wishlist', USCES_MEMBER_URL)); ?>"><?php echo esc_html($dp_options['product_wishlist_title']); ?></a></li>
								</ul>
							<?php
							elseif (is_woocommerce_active()) :
							?>
								<ul class="p-drawer__membermenu p-drawer__membermenu02 p-drawer__menu">
									<?php
									if (is_user_logged_in()) :
									?>
										<li class="p-header__membermenu-mypage"><a href="<?php echo esc_attr(wc_get_account_endpoint_url('dashboard')); ?>"><?php echo esc_html(get_woocommerce_myaccount_page_title()); ?></a></li>
									<?php
									else :
									?>
										<li class="p-header__membermenu-login"><a href="<?php echo esc_attr(wc_get_account_endpoint_url('dashboard')); ?>"><?php _e('Login / Registration', 'tcd-w'); ?></a></li>
									<?php
									endif;
									?>
									<li class="p-header__membermenu-wishlist"><a href="<?php echo esc_attr(wc_get_account_endpoint_url('wishlist')); ?>"><?php echo esc_html($dp_options['product_wishlist_title']); ?></a></li>
								</ul>
							<?php
							endif;

							if (function_exists('usces_remove_filter')) :
								usces_remove_filter();
							endif;

							if (has_nav_menu('global')) :
								wp_nav_menu(array(
									'container' => 'nav',
									'container_class' => 'p-global-nav__container',
									'depth' => 4,
									'menu_class' => 'p-global-nav p-drawer__menu',
									'menu_id' => 'js-global-nav',
									'theme_location' => 'global',
									'link_after' => '<span class="p-global-nav__toggle"></span>'
								));
							endif;

							if (is_welcart_active()) :
							?>
								<ul class="p-drawer__membermenu p-drawer__menu">
									<?php
									if (usces_is_membersystem_state()) :
										if (usces_is_login()) :
									?>
											<li><a href="<?php echo esc_attr(USCES_LOGOUT_URL); ?>"><?php _e('Logout', 'tcd-w'); ?></a></li>
										<?php
										else :
										?>
											<li><a href="<?php echo esc_attr(USCES_NEWMEMBER_URL); ?>"><?php _e('Registration', 'tcd-w'); ?></a></li>
									<?php
										endif;
									endif;
									?>
								</ul>
							<?php
							elseif (is_woocommerce_active() && is_user_logged_in()) :
							?>
								<ul class="p-drawer__membermenu p-drawer__menu">
									<li><a href="<?php echo esc_attr(wc_logout_url()); ?>"><?php _e('Logout', 'tcd-w'); ?></a></li>
								</ul>
							<?php
							endif;

							if ($dp_options['drawer_banner_code1'] || $dp_options['drawer_banner_image1'] || $dp_options['drawer_banner_code2'] || $dp_options['drawer_banner_image2'] || $dp_options['drawer_banner_code3'] || $dp_options['drawer_banner_image3']) :
								the_widget(
									'tcdw_ad_widget',
									array(
										'title' => '',
										'banner_code1' => $dp_options['drawer_banner_code1'],
										'banner_image1' => $dp_options['drawer_banner_image1'],
										'banner_url1' => $dp_options['drawer_banner_url1'],
										'banner_code2' => $dp_options['drawer_banner_code2'],
										'banner_image2' => $dp_options['drawer_banner_image2'],
										'banner_url2' => $dp_options['drawer_banner_url2'],
										'banner_code3' => $dp_options['drawer_banner_code3'],
										'banner_image3' => $dp_options['drawer_banner_image3'],
										'banner_url3' => $dp_options['drawer_banner_url3'],
									),
									array(
										'id' => 'drawer_widget_mobile',
										'before_widget' => '<div class="p-widget p-widget-drawer tcdw_ad_widget">' . "\n",
										'after_widget' => "</div>\n",
										'before_title' => '<h2 class="p-widget__title">',
										'after_title' => '</h2>' . "\n"
									)
								);
							endif;
							?>
						</div>
						<div class="p-drawer-overlay"></div>
					</div>
					<?php
					if (is_welcart_active()) :
					?>
						<ul class="p-header__membermenu">
							<li class="p-header__membermenu-wishlist u-hidden-sm"><a href="<?php echo esc_attr(add_query_arg('page', 'wishlist', USCES_MEMBER_URL)); ?>"><span class="p-header__membermenu-wishlist__count"><?php if ($like_cout = get_like_count()) echo absint($like_cout); ?></span></a></li>
							<?php
							if (usces_is_membersystem_state()) :
								if (usces_is_login()) :
							?>
									<li class="p-header__membermenu-mypage u-hidden-sm"><a class="js-header__membermenu-memberbox" href="<?php echo esc_attr(USCES_MEMBER_URL); ?>"></a></li>
								<?php
								else :
								?>
									<li class="p-header__membermenu-mypage u-hidden-sm"><a class="js-header__membermenu-memberbox" href="<?php echo esc_attr(USCES_LOGIN_URL); ?>"></a></li>
							<?php
								endif;
							endif;
							?>
							<li class="p-header__membermenu-cart"><a class="js-header-cart" href="<?php echo esc_attr(USCES_CART_URL); ?>"><span class="p-header__membermenu-cart__badge"><?php echo $totalquantity; ?></span></a></li>
						</ul>
					<?php
					elseif (is_woocommerce_active()) :
					?>
						<ul class="p-header__membermenu">
							<li class="p-header__membermenu-wishlist u-hidden-sm"><a href="<?php echo esc_attr(wc_get_account_endpoint_url('wishlist')); ?>"><span class="p-header__membermenu-wishlist__count"><?php if ($like_cout = get_like_count()) echo absint($like_cout); ?></span></a></li>
							<?php
							if (is_user_logged_in()) :
							?>
								<li class="p-header__membermenu-mypage u-hidden-sm"><a class="js-header__membermenu-memberbox" href="<?php echo esc_attr(wc_get_account_endpoint_url('dashboard')); ?>"></a></li>
							<?php
							else :
							?>
								<li class="p-header__membermenu-mypage u-hidden-sm"><a class="js-header__membermenu-memberbox" href="<?php echo esc_attr(wc_get_account_endpoint_url('dashboard')); ?>"></a></li>
							<?php
							endif;
							?>
							<li class="p-header__membermenu-cart"><a class="js-header-cart" href="<?php echo esc_attr(wc_get_cart_url()); ?>"><span class="p-header__membermenu-cart__badge"><?php echo $totalquantity; ?></span></a></li>
						</ul>
					<?php
					endif;
					?>
					<button id="js-menu-button" class="p-menu-button c-icon-button">&#xf0c9;</button>
					<?php
					get_template_part('template-parts/header-login');
					get_template_part('template-parts/header-view-cart');
					?>
				</div>
				<?php
				if (function_exists('usces_remove_filter')) :
					usces_remove_filter();
				endif;

				get_template_part('template-parts/megamenu');

				if (function_exists('usces_reset_filter')) :
					usces_reset_filter();
				endif;
				?>
			</div>
		</div>
	</header>