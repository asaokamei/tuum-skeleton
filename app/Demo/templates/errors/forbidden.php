<?php
use League\Plates\Template\Template;
use Tuum\Respond\Service\ViewHelper;

/** @var Template $this */
/** @var ViewHelper $view */

$this->layout('layouts/layout', ['view' => $view]);

?>

<?php $this->start('contents'); ?>

    <h1>Forbidden Error</h1>

    <p>Sorry, the URL is not allowed to access. </p>
    <p><a href="/">start from the beginning!</a></p>

<?php $this->stop(); ?>