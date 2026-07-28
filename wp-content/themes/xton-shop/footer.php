<?php

/**
 * Stopka i zamknięcie dokumentu.
 *
 * Stopka wg referencji Figma (XTON homepage — node 2218-4147), w wariancie
 * JASNYM (light mode, D-014/D-016): logo → 4 kolumny (informacje firmowe,
 * kontakt, na skróty, o nas) → social + certyfikaty/partnerzy → pasek dolny.
 * Dane firmowe i linki to placeholdery z projektu — docelowo z opcji/menu WP.
 *
 * @package XtonShop
 */

declare(strict_types=1);

// Telefony działu sprzedaży (z flagą języka obsługi).
$footer_sales = [
    ['num' => '+48 18 479 16 01', 'flag' => 'pl'],
    ['num' => '+48 535 530 824', 'flag' => 'pl'],
    ['num' => '+48 515 991 080', 'flag' => 'uk'],
];

// Kolumny linków (placeholdery — docelowo menu WP).
$footer_shortcuts = ['System logowania', 'Zgłoszenie leada', 'Zgłoszenie serwisu', 'Materiały do pobrania', 'FAQ'];
$footer_about     = ['O firmie', 'Misja', 'Certyfikaty', 'Galeria', 'Społeczna odpowiedzialność'];

$footer_socials = [
    ['icon' => 'fb', 'label' => 'Facebook'],
    ['icon' => 'ig', 'label' => 'Instagram'],
    ['icon' => 'yt', 'label' => 'YouTube'],
    ['icon' => 'tiktok', 'label' => 'TikTok'],
    ['icon' => 'linkedin', 'label' => 'LinkedIn'],
];

$footer_certs   = ['ce', 'gs1', 'upr'];
$footer_flags   = ['pl', 'eu'];
$footer_partners = [
    ['file' => 'rzetelna-firma.png', 'alt' => 'Rzetelna Firma', 'class' => 'h-12'],
    ['file' => 'malopolska.png', 'alt' => 'Małopolska', 'class' => 'h-10'],
    ['file' => 'nowy-sacz.svg', 'alt' => 'Nowy Sącz', 'class' => 'h-8'],
];

$heading_class = 'mb-4 text-sm font-medium uppercase tracking-wide';

?>
<footer class="site-footer border-t border-base-300 bg-base-200 text-base-content" role="contentinfo">
    <div class="container py-12 md:py-16">

        <div class="footer-logo mb-10">
            <a class="inline-block text-base-content" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                <?php echo xton_inline_svg('img/xton-logo.svg'); // phpcs:ignore WordPress.Security.EscapeOutput ?>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">

            <?php // ===== Informacje firmowe ===== ?>
            <div>
                <h2 class="<?php echo esc_attr($heading_class); ?>"><?php esc_html_e('Informacje firmowe', 'xton-shop'); ?></h2>
                <div class="flex flex-col gap-1.5 text-base leading-tight">
                    <p>XTON Sp. z o. o.</p>
                    <p>ul. Stanisława Wigury 14</p>
                    <p>33-300 Nowy Sącz, POLAND</p>
                    <p><a class="footer-link" href="tel:+48184791601">+48 18 479 16 01</a></p>
                    <p><a class="footer-link" href="mailto:info@xton.eu">info@xton.eu</a></p>
                    <p class="mt-1.5">VAT EU: PL7343606177</p>
                    <p>KRS: 0000122264</p>
                    <p>NIP: 7343606177</p>
                </div>
            </div>

            <?php // ===== Kontakt ===== ?>
            <div>
                <h2 class="<?php echo esc_attr($heading_class); ?>"><?php esc_html_e('Kontakt', 'xton-shop'); ?></h2>
                <div class="flex flex-col gap-1.5 text-base leading-tight">
                    <p><?php esc_html_e('Dział sprzedaży:', 'xton-shop'); ?></p>
                    <?php foreach ($footer_sales as $sale) : ?>
                        <p class="flex items-center gap-2">
                            <a class="footer-link" href="tel:<?php echo esc_attr(str_replace(' ', '', $sale['num'])); ?>"><?php echo esc_html($sale['num']); ?></a>
                            <img class="h-3 w-auto rounded-xs" src="<?php echo esc_url(xton_asset('flags/flag-' . $sale['flag'] . '.png')); ?>" alt="" width="18" height="12" aria-hidden="true">
                        </p>
                    <?php endforeach; ?>

                    <p class="mt-1.5"><?php esc_html_e('Serwis:', 'xton-shop'); ?></p>
                    <p><a class="footer-link" href="tel:+48184791631">+48 18 479 16 31</a></p>

                    <p class="mt-1.5">Perfect Service BDO</p>
                    <p><a class="footer-link" href="tel:+48184791648">+48 18 479 16 48</a></p>
                </div>
            </div>

            <?php // ===== Na skróty ===== ?>
            <nav class="footer-nav" aria-label="<?php esc_attr_e('Na skróty', 'xton-shop'); ?>">
                <h2 class="<?php echo esc_attr($heading_class); ?>"><?php esc_html_e('Na skróty', 'xton-shop'); ?></h2>
                <ul class="flex flex-col gap-1.5 text-base leading-tight">
                    <?php foreach ($footer_shortcuts as $label) : ?>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($label); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <?php // ===== O nas ===== ?>
            <nav class="footer-nav" aria-label="<?php esc_attr_e('O nas', 'xton-shop'); ?>">
                <h2 class="<?php echo esc_attr($heading_class); ?>"><?php esc_html_e('O nas', 'xton-shop'); ?></h2>
                <ul class="flex flex-col gap-1.5 text-base leading-tight">
                    <?php foreach ($footer_about as $label) : ?>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($label); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>

        <?php // ===== Social + certyfikaty / partnerzy ===== ?>
        <div class="mt-12 flex flex-col gap-10 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h2 class="<?php echo esc_attr($heading_class); ?>"><?php esc_html_e('Zaobserwuj nas', 'xton-shop'); ?></h2>
                <ul class="footer-social flex items-center gap-6">
                    <?php foreach ($footer_socials as $social) : ?>
                        <li>
                            <a class="inline-flex text-base-content/70 hover:text-base-content" href="#" aria-label="<?php echo esc_attr($social['label']); ?>" target="_blank" rel="noopener noreferrer">
                                <?php echo xton_inline_svg('icons/' . $social['icon'] . '.svg'); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="flex flex-col gap-6">
                <div class="footer-badges flex flex-wrap items-center gap-5 text-base-content">
                    <?php foreach ($footer_certs as $cert) : ?>
                        <span class="inline-flex"><?php echo xton_inline_svg('certs/' . $cert . '.svg'); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
                    <?php endforeach; ?>
                    <?php foreach ($footer_flags as $flag) : ?>
                        <img class="h-4 w-auto rounded-xs" src="<?php echo esc_url(xton_asset('flags/flag-' . $flag . '.png')); ?>" alt="" width="26" height="17" aria-hidden="true">
                    <?php endforeach; ?>
                </div>
                <div class="flex flex-wrap items-center gap-6">
                    <?php foreach ($footer_partners as $partner) : ?>
                        <img class="<?php echo esc_attr($partner['class']); ?> w-auto" src="<?php echo esc_url(xton_asset('logos/' . $partner['file'])); ?>" alt="<?php echo esc_attr($partner['alt']); ?>">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php // ===== Pasek dolny ===== ?>
        <div class="mt-10 flex flex-col gap-2 border-t border-base-300 pt-6 text-sm sm:flex-row sm:items-center sm:justify-between">
            <a class="footer-link w-fit" href="<?php echo esc_url(home_url('/polityka-prywatnosci/')); ?>">
                <?php esc_html_e('Polityka prywatności', 'xton-shop'); ?>
            </a>
            <p class="text-base-content/60">
                <?php bloginfo('name'); ?>&reg; <?php esc_html_e('Wszelkie prawa zastrzeżone', 'xton-shop'); ?> <?php echo esc_html(date_i18n('Y')); ?>
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
