<?php

declare(strict_types=1);

namespace XtonShop\Acf;

use XtonShop\Support\Contracts\Bootable;

/**
 * Integracja z ACF Pro. Grupy pól rejestrujemy DEKLARATYWNIE w kodzie
 * (na hooku acf/init) — nigdy w panelu. Moduł jest bezpieczny, gdy ACF nieaktywny.
 */
final class Acf implements Bootable
{
    /**
     * Deklaratywne grupy pól.
     *
     * @var array<int, class-string<FieldGroup>>
     */
    private const GROUPS = [];

    public function boot(): void
    {
        // Brak ACF → moduł nic nie robi (motyw działa dalej).
        if (! function_exists('acf_add_local_field_group')) {
            return;
        }

        add_action('acf/init', [$this, 'registerFieldGroups']);
    }

    public function registerFieldGroups(): void
    {
        foreach (self::GROUPS as $group) {
            acf_add_local_field_group((new $group())->definition());
        }
    }
}
