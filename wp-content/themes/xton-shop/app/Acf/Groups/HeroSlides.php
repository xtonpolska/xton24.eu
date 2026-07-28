<?php

declare(strict_types=1);

namespace XtonShop\Acf\Groups;

use XtonShop\Acf\Acf;
use XtonShop\Acf\FieldGroup;

/**
 * Slajdy hero (carousel na stronie głównej) — repeater na stronie opcji motywu.
 * Nazwy pól odpowiadają danym używanym w templates/parts/home/carousel.php.
 */
final class HeroSlides implements FieldGroup
{
    public function definition(): array
    {
        return [
            'key'        => 'group_xton_hero_slides',
            'title'      => __('Hero — slajdy', 'xton-shop'),
            'menu_order' => 0,
            'position'   => 'normal',
            'style'      => 'default',
            'active'     => true,
            'fields'     => [
                [
                    'key'          => 'field_xton_hero_slides',
                    'label'        => __('Slajdy', 'xton-shop'),
                    'name'         => 'hero_slides',
                    'type'         => 'repeater',
                    'layout'       => 'block',
                    'button_label' => __('Dodaj slajd', 'xton-shop'),
                    'min'          => 0,
                    'sub_fields'   => [
                        [
                            'key'   => 'field_xton_hero_eyebrow',
                            'label' => __('Etykieta (eyebrow)', 'xton-shop'),
                            'name'  => 'eyebrow',
                            'type'  => 'text',
                        ],
                        [
                            'key'      => 'field_xton_hero_title',
                            'label'    => __('Nagłówek', 'xton-shop'),
                            'name'     => 'title',
                            'type'     => 'text',
                            'required' => 1,
                        ],
                        [
                            'key'   => 'field_xton_hero_text',
                            'label' => __('Opis', 'xton-shop'),
                            'name'  => 'text',
                            'type'  => 'textarea',
                            'rows'  => 3,
                        ],
                        [
                            'key'           => 'field_xton_hero_image',
                            'label'         => __('Obraz tła', 'xton-shop'),
                            'name'          => 'image',
                            'type'          => 'image',
                            'return_format' => 'array',
                            'preview_size'  => 'large',
                            'library'       => 'all',
                            'mime_types'    => 'jpg,jpeg,png,webp',
                        ],
                        [
                            'key'   => 'field_xton_hero_cta_label',
                            'label' => __('Przycisk — tekst', 'xton-shop'),
                            'name'  => 'cta_label',
                            'type'  => 'text',
                        ],
                        [
                            'key'   => 'field_xton_hero_cta_url',
                            'label' => __('Przycisk — adres URL', 'xton-shop'),
                            'name'  => 'cta_url',
                            'type'  => 'url',
                        ],
                        [
                            'key'   => 'field_xton_hero_link_label',
                            'label' => __('Link dodatkowy — tekst', 'xton-shop'),
                            'name'  => 'link_label',
                            'type'  => 'text',
                        ],
                        [
                            'key'   => 'field_xton_hero_link_url',
                            'label' => __('Link dodatkowy — adres URL', 'xton-shop'),
                            'name'  => 'link_url',
                            'type'  => 'url',
                        ],
                    ],
                ],
            ],
            'location'   => [
                [
                    [
                        'param'    => 'options_page',
                        'operator' => '==',
                        'value'    => Acf::OPTIONS_SLUG,
                    ],
                ],
            ],
        ];
    }
}
