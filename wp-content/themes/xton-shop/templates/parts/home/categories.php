<?php

/**
 * Sekcja kategorii — kolaż/masonry wg referencji Figma (node 2210-3444).
 *
 * Light mode: sekcja na jasnym tle, kafle to ciemne zdjęcia z gradientem
 * (samo-kontrastujące), z tytułem (Russo One), opisem i CTA. Układ masonry:
 * kafel szeroki + wysoki + zwykłe (spany siatki na ≥1024px).
 *
 * DANE z xton24.pl (nazwy/kategorie). Grafiki placeholder (placehold.co) i
 * linki `#` — do podmiany na realne obrazy i lokalne taksonomie WooCommerce.
 *
 * @package XtonShop
 */

declare(strict_types=1);

$categories = [
    [
        'title'   => 'Piaskarki',
        'desc'    => 'Skuteczne usuwanie korozji i powłok w nowoczesnym serwisie.',
        'url'     => '#',
        'image'   => 'https://placehold.co/900x600/1f1f1f/cdcdcd?text=Piaskarki',
        'modifier' => 'cat-tile--wide',
    ],
    [
        'title'   => 'Systemy do czyszczenia DPF',
        'desc'    => 'Czyszczenie i regeneracja filtrów DPF w warsztatach.',
        'url'     => '#',
        'image'   => 'https://placehold.co/700x1000/171717/cdcdcd?text=DPF',
        'modifier' => 'cat-tile--tall',
    ],
    [
        'title'   => 'Myjki warsztatowe',
        'desc'    => 'Profesjonalne mycie części i podzespołów.',
        'url'     => '#',
        'image'   => 'https://placehold.co/700x600/262626/cdcdcd?text=Myjki',
        'modifier' => '',
    ],
    [
        'title'   => 'Master Box™',
        'desc'    => 'Gotowe zestawy maszyn dla serwisu automotive.',
        'url'     => '#',
        'image'   => 'https://placehold.co/700x600/1f1f1f/cdcdcd?text=Master+Box',
        'modifier' => '',
    ],
    [
        'title'   => 'Chemia XPOWER',
        'desc'    => 'Profesjonalna chemia i płyny eksploatacyjne.',
        'url'     => '#',
        'image'   => 'https://placehold.co/900x600/262626/cdcdcd?text=Chemia+XPOWER',
        'modifier' => 'cat-tile--wide',
    ],
    [
        'title'   => 'Materiały eksploatacyjne',
        'desc'    => 'Akcesoria, części i materiały do maszyn.',
        'url'     => '#',
        'image'   => 'https://placehold.co/700x600/171717/cdcdcd?text=Akcesoria',
        'modifier' => '',
    ],
];
?>

<section class="home-categories" aria-labelledby="categories-title">
    <div class="container">
        <header class="section-head">
            <p class="section-head__eyebrow"><?php esc_html_e('Asortyment', 'xton-shop'); ?></p>
            <h2 class="section-head__title" id="categories-title"><?php esc_html_e('Kategorie', 'xton-shop'); ?></h2>
        </header>

        <div class="cat-collage">
            <?php foreach ($categories as $cat) : ?>
                <a class="cat-tile <?php echo esc_attr($cat['modifier']); ?>" href="<?php echo esc_url($cat['url']); ?>">
                    <span class="cat-tile__img" aria-hidden="true">
                        <img src="<?php echo esc_url($cat['image']); ?>" alt="" loading="lazy">
                    </span>
                    <span class="cat-tile__body">
                        <span class="cat-tile__title"><?php echo esc_html($cat['title']); ?></span>
                        <span class="cat-tile__desc"><?php echo esc_html($cat['desc']); ?></span>
                        <span class="cat-tile__more">
                            <?php esc_html_e('Dowiedz się więcej', 'xton-shop'); ?>
                            <span class="cat-tile__arrow" aria-hidden="true">&rarr;</span>
                        </span>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
