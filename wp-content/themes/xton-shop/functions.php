<?php

/**
 * Bootstrap motywu Xton Shop.
 *
 * @package XtonShop
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit; // Brak bezpośredniego dostępu.
}

define('XTON_SHOP_VERSION', '0.2.0');
define('XTON_SHOP_DIR', get_template_directory());
define('XTON_SHOP_URI', get_template_directory_uri());

/**
 * URL statycznego assetu motywu (SVG/obraz) z cache-bustingiem po wersji.
 * Assety statyczne (nie przez Vite) leżą w `assets/`.
 */
function xton_asset(string $relative): string
{
    return XTON_SHOP_URI . '/' . ltrim($relative, '/') . '?ver=' . XTON_SHOP_VERSION;
}

/**
 * Inline'uje SVG z katalogu `assets/` (zaufane pliki motywu). Dzięki temu ikony
 * używają `currentColor` — dziedziczą kolor tekstu rodzica i skalują się z nim.
 * Wynik trafia bezpośrednio do markupu, więc echo bez wp_kses (lokalne pliki).
 */
function xton_inline_svg(string $relative): string
{
    $file = XTON_SHOP_DIR . '/assets/' . ltrim($relative, '/');

    return is_readable($file) ? (string) file_get_contents($file) : '';
}

/**
 * Fallback menu głównego — gdy właściciel nie przypisał jeszcze menu do
 * lokalizacji „primary". Odwzorowuje pozycje z referencji Figma, żeby header
 * wyglądał poprawnie od razu. Docelowo zastępowane przez menu z panelu WP.
 */
function xton_primary_menu_fallback(): void
{
    $items = [
        ['label' => 'Offer', 'children' => true],
        ['label' => 'Shop', 'children' => true],
        ['label' => 'Blog', 'children' => true],
        ['label' => 'About', 'children' => true],
        ['label' => 'Contact', 'children' => false],
    ];

    echo '<ul id="primary-menu" class="primary-menu">';

    foreach ($items as $item) {
        $classes = 'menu-item' . ($item['children'] ? ' menu-item-has-children' : '');
        printf(
            '<li class="%s"><a href="%s">%s</a></li>',
            esc_attr($classes),
            esc_url(home_url('/')),
            esc_html($item['label'])
        );
    }

    echo '</ul>';
}

$xtonShopAutoload = XTON_SHOP_DIR . '/vendor/autoload.php';

if (! is_readable($xtonShopAutoload)) {
    add_action('admin_notices', static function (): void {
        echo '<div class="notice notice-error"><p>';
        echo esc_html__(
            'Xton Shop: brak vendor/autoload.php — uruchom "composer install" w katalogu motywu.',
            'xton-shop'
        );
        echo '</p></div>';
    });

    return;
}

require $xtonShopAutoload;

XtonShop\Theme::boot();
