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
