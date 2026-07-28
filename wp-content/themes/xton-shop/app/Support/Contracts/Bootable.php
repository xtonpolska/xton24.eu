<?php

declare(strict_types=1);

namespace XtonShop\Support\Contracts;

/**
 * Moduł motywu, który podpina swoje hooki do WordPressa.
 */
interface Bootable
{
    /**
     * Rejestruje hooki/akcje modułu. Wywoływane raz podczas bootstrapu motywu.
     */
    public function boot(): void;
}
