<?php
use League\Plates\Template\Template;
use Tuum\Respond\Service\ViewHelper;

/** @var Template $this */
/** @var ViewHelper $view */

$this->layout('layouts/layout', ['view' => $view]);

?>

<?php $this->start('contents'); ?>

<?= isset($contents) ? $contents: ''; ?>

<?php $this->stop(); ?>
