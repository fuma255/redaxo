<?php
@trigger_error("The core/footer.php fragment is deprecated and will be removed in a future version.", E_USER_DEPRECATED);
?>
    <footer class="rex-global-footer">
        <nav class="rex-nav-footer">
            <ul class="list-inline">
                <li><a href="#rex-start-of-page"><i class="fa fa-arrow-up"></i></a></li>
                <li><a href="https://www.yakamara.de" target="_blank" rel="noreferrer noopener">yakamara.de</a></li>
                <li><a href="https://www.redaxo.org" target="_blank" rel="noreferrer noopener">redaxo.org</a></li>
                <?php if (rex::getUser() && rex::getUser()->isAdmin()): ?>
                    <li><a href="https://www.redaxo.org/doku/master" target="_blank" rel="noreferrer noopener' ?>"><?php echo rex_i18n::msg('footer_doku'); ?></a></li>
                <?php endif; ?>
                <li><a href="<?php echo rex::getUser() ? rex_url::backendPage('credits') : 'https://www.redaxo.org/" target="_blank" rel="noreferrer noopener' ?>"><?php echo rex_i18n::msg('footer_credits'); ?></a></li>
                <li><?php echo rex_i18n::msg('footer_datetime', rex_formatter::strftime(time(), 'date')); ?></li>
                <li class="rex-js-script-time"><!--DYN--><?php echo rex_i18n::msg('footer_scripttime', $this->time); ?><!--/DYN--></li>
            </ul>
        </nav>
    </footer>
