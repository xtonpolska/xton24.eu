<?php

/**
 * Stopka i zamknięcie dokumentu.
 *
 * @package XtonShop
 */

declare(strict_types=1);

?>
<footer class="site-footer border-t border-base-200 mt-12" role="contentinfo">
    <div class="container flex flex-col gap-4 py-8 md:flex-row md:items-center md:justify-between">
        <p class="text-sm text-base-content/70">
            &copy; <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?>.
            <?php esc_html_e('Wszelkie prawa zastrzeżone.', 'xton-shop'); ?>
        </p>

        <nav class="footer-navigation" aria-label="<?php esc_attr_e('Nawigacja w stopce', 'xton-shop'); ?>">
            <?php
            wp_nav_menu([
                'theme_location' => 'footer',
                'container'      => false,
                'menu_class'     => 'flex flex-wrap gap-4 text-sm',
                'fallback_cb'    => false,
                'depth'          => 1,
            ]);
            ?>
        </nav>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
