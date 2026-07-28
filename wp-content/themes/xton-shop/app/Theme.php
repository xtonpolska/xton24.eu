<?php

declare(strict_types=1);

namespace XtonShop;

use XtonShop\Assets\ViteAssets;
use XtonShop\Setup\Cleanup;
use XtonShop\Setup\Menus;
use XtonShop\Setup\ThemeSupport;
use XtonShop\Setup\WooCommerce;
use XtonShop\Support\Contracts\Bootable;

/**
 * Bootstrap motywu. Rejestruje i uruchamia moduły (Bootable).
 */
final class Theme
{
    private static ?self $instance = null;

    /**
     * Moduły motywu w kolejności bootowania.
     *
     * @var array<int, class-string<Bootable>>
     */
    private const MODULES = [
        ThemeSupport::class,
        Menus::class,
        Cleanup::class,
        ViteAssets::class,
        WooCommerce::class,
    ];

    private function __construct()
    {
    }

    /**
     * Uruchamia motyw. Idempotentne — kolejne wywołania są ignorowane.
     */
    public static function boot(): void
    {
        if (self::$instance instanceof self) {
            return;
        }

        self::$instance = new self();
        self::$instance->registerModules();
    }

    private function registerModules(): void
    {
        foreach (self::MODULES as $module) {
            $instance = new $module();

            if ($instance instanceof Bootable) {
                $instance->boot();
            }
        }
    }
}
