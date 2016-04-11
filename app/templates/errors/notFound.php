<?php
use League\Plates\Template\Template;
use Tuum\Respond\Service\ViewHelper;

/** @var Template $this */
/** @var ViewHelper $view */

$this->layout('layouts/layout', ['view' => $view]);

?>

<?php $this->start('contents'); ?>

    <h1>File Not Found</h1>

    <p>File or resource you have requested for was not found. </p>
    <p><a href="/">start from the beginning!</a></p>

<?php $this->stop(); ?>