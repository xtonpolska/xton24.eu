<?php

/**
 * Nagłówek dokumentu i otwarcie <body>.
 *
 * Header sklepu wg referencji Figma (XTON homepage — sekcja nagłówka), ale
 * w wariancie JASNYM (light mode, D-014): górny pasek (kontakt + język) i główny
 * (logo → nawigacja → social). Ikony i logo inline'owane jako SVG (currentColor),
 * więc dziedziczą kolor tekstu. Responsywny: na mobile nawigacja chowa się pod
 * przyciskiem (hamburger), sterowanym przez `resources/js/modules/header-nav.ts`.
 *
 * @package XtonShop
 */

declare(strict_types=1);

// Ikony social (wg Figmy). Docelowe URL-e do uzupełnienia (TODO: opcje motywu).
$xton_socials = [
    ['icon' => 'fb', 'label' => 'Facebook', 'url' => '#'],
    ['icon' => 'ig', 'label' => 'Instagram', 'url' => '#'],
    ['icon' => 'yt', 'label' => 'YouTube', 'url' => '#'],
    ['icon' => 'tiktok', 'label' => 'TikTok', 'url' => '#'],
    ['icon' => 'linkedin', 'label' => 'LinkedIn', 'url' => '#'],
];

?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen bg-base-100 text-base-content antialiased'); ?>>
<?php wp_body_open(); ?>

<a class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:top-2 focus:left-2 btn btn-primary" href="#main">
    <?php esc_html_e('Przejdź do treści', 'xton-shop'); ?>
</a>

<header class="site-header border-b border-base-200 bg-base-100 text-base-content" role="banner">
    <div class="container">

        <?php // ===== Górny pasek: dane kontaktowe + język ===== ?>
        <div class="site-header__topbar flex flex-wrap items-center justify-between gap-x-8 gap-y-2 border-b border-base-200 py-2.5 text-xs text-base-content/60">
            <ul class="flex flex-wrap items-center gap-x-8 gap-y-1">
                <li>
                    <a class="inline-flex items-center gap-1.5 hover:text-base-content" href="mailto:sales@xton.eu">
                        <span class="inline-flex text-secondary"><?php echo xton_inline_svg('icons/mail.svg'); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
                        sales@xton.eu
                    </a>
                </li>
                <li>
                    <a class="inline-flex items-center gap-1.5 hover:text-base-content" href="tel:+48184791611">
                        <span class="inline-flex text-secondary"><?php echo xton_inline_svg('icons/phone.svg'); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
                        +48 18 479 16 11
                    </a>
                </li>
                <li class="hidden items-center gap-1.5 sm:inline-flex">
                    <span class="inline-flex"><?php echo xton_inline_svg('icons/clock.svg'); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
                    <span>08:00&ndash;16:00 GMT +1</span>
                </li>
            </ul>

            <?php // Przełącznik języka — placeholder wizualny (TODO: integracja i18n, np. Polylang). ?>
            <button
                type="button"
                class="hidden items-center gap-1.5 rounded-[3px] border border-base-300 px-2 py-1 hover:text-base-content sm:inline-flex"
                aria-label="<?php esc_attr_e('Zmiana języka', 'xton-shop'); ?>"
            >
                <span class="inline-flex"><?php echo xton_inline_svg('icons/globe.svg'); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
                <span>English</span>
                <svg class="size-2.5" viewBox="0 0 10 6" fill="none" aria-hidden="true">
                    <path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <?php // ===== Główny pasek: logo → nawigacja → social ===== ?>
        <div class="site-header__main flex items-center justify-between gap-6 py-5">
            <a class="site-branding shrink-0 text-base-content" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <?php echo xton_inline_svg('img/xton-logo.svg'); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                <?php endif; ?>
            </a>

            <button
                type="button"
                class="site-nav-toggle"
                data-nav-toggle
                aria-expanded="false"
                aria-controls="primary-navigation"
                aria-label="<?php esc_attr_e('Menu', 'xton-shop'); ?>"
            >
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav id="primary-navigation" class="primary-navigation" aria-label="<?php esc_attr_e('Nawigacja główna', 'xton-shop'); ?>" data-nav>
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'primary-menu',
                    'fallback_cb'    => 'xton_primary_menu_fallback',
                    'depth'          => 2,
                ]);
                ?>
            </nav>

            <ul class="site-social hidden shrink-0 items-center gap-4 lg:flex">
                <?php foreach ($xton_socials as $social) : ?>
                    <li>
                        <a class="inline-flex text-base-content/60 hover:text-base-content" href="<?php echo esc_url($social['url']); ?>" aria-label="<?php echo esc_attr($social['label']); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo xton_inline_svg('icons/' . $social['icon'] . '.svg'); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</header>
