<?php

declare(strict_types=1);

namespace XtonShop\Acf;

use XtonShop\Acf\Groups\HeroSlides;
use XtonShop\Support\Contracts\Bootable;

/**
 * Integracja z ACF Pro. Pola i strony opcji rejestrujemy DEKLARATYWNIE w kodzie
 * (na hooku acf/init) — nigdy w panelu. Moduł jest bezpieczny, gdy ACF nieaktywny.
 */
final class Acf implements Bootable
{
    /** Slug strony opcji z globalnymi ustawieniami motywu. */
    public const OPTIONS_SLUG = 'xton-ustawienia';

    /**
     * Deklaratywne grupy pól.
     *
     * @var array<int, class-string<FieldGroup>>
     */
    private const GROUPS = [
        HeroSlides::class,
    ];

    public function boot(): void
    {
        // Brak ACF → moduł nic nie robi (motyw działa dalej).
        if (! function_exists('acf_add_local_field_group')) {
            return;
        }

        add_action('acf/init', [$this, 'registerOptionsPages']);
        add_action('acf/init', [$this, 'registerFieldGroups']);
    }

    public function registerOptionsPages(): void
    {
        if (! function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_page([
            'page_title' => __('Ustawienia motywu', 'xton-shop'),
            'menu_title' => __('Ustawienia motywu', 'xton-shop'),
            'menu_slug'  => self::OPTIONS_SLUG,
            'capability' => 'manage_options',
            'position'   => 59,
            'icon_url'   => 'dashicons-admin-customizer',
            'redirect'   => false,
        ]);
    }

    public function registerFieldGroups(): void
    {
        foreach (self::GROUPS as $group) {
            acf_add_local_field_group((new $group())->definition());
        }
    }
}
