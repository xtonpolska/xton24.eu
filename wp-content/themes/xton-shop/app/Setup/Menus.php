<?php

declare(strict_types=1);

namespace XtonShop\Setup;

use XtonShop\Support\Contracts\Bootable;

/**
 * Rejestruje lokalizacje menu nawigacyjnych.
 */
final class Menus implements Bootable
{
    public function boot(): void
    {
        add_action('after_setup_theme', [$this, 'register']);
    }

    public function register(): void
    {
        register_nav_menus([
            'primary' => __('Menu główne', 'xton-shop'),
            'footer'  => __('Menu w stopce', 'xton-shop'),
        ]);
    }
}
