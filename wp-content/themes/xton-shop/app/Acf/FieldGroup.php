<?php

declare(strict_types=1);

namespace XtonShop\Acf;

/**
 * Deklaratywna definicja grupy pól ACF (rejestrowana w kodzie, nie w panelu).
 */
interface FieldGroup
{
    /**
     * Zwraca tablicę argumentów dla acf_add_local_field_group().
     *
     * @return array<string, mixed>
     */
    public function definition(): array;
}
