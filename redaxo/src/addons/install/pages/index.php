<?php

$page = rex_be_controller::getCurrentPagePart(1);
$subpage = rex_be_controller::getCurrentPagePart(2, 'packages');

echo rex_view::title($this->i18n('title'));

if ($subpage == 'packages') {
  $subpage = rex_be_controller::getCurrentPagePart(3, 'update');
}

include $this->getPath('pages/' . $subpage . '.php');